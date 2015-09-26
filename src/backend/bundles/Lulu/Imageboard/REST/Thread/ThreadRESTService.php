<?php
namespace Lulu\Imageboard\REST\Thread;

use League\Route\Http\Exception\NotFoundException;
use League\Route\Http\JsonResponse\Ok;
use League\Route\RouteCollection;
use Lulu\Imageboard\Domain\Repository\Board\BoardRepositoryInterface;
use Lulu\Imageboard\Domain\Repository\Thread\Component\ThreadListQuery;
use Lulu\Imageboard\Domain\Entity\Thread;
use Lulu\Imageboard\Domain\Repository\Thread\ThreadRepositoryInterface;
use Lulu\Imageboard\REST\Post\Util\CreatePostFromRequest;
use Lulu\Imageboard\REST\RESTServiceInterface;
use Lulu\Imageboard\Util\Seek\Seek;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ThreadRESTService implements RESTServiceInterface
{
    const MAX_LIMIT = 1000;
    const DEFAULT_LIMIT = 10;

    /**
     * Thread repository
     * @var ThreadRepositoryInterface
     */
    private $threadRepository;

    /**
     * Board repository
     * @var BoardRepositoryInterface
     */
    private $boardRepository;

    /**
     * ThreadRESTService constructor.
     * @param ThreadRepositoryInterface $threadRepository
     * @param BoardRepositoryInterface $boardRepository
     */
    public function __construct(ThreadRepositoryInterface $threadRepository, BoardRepositoryInterface $boardRepository) {
        $this->threadRepository = $threadRepository;
        $this->boardRepository = $boardRepository;
    }

    /**
     * @inheritdoc
     */
    public function initRoutes(RouteCollection $routes) {
        $this->routeGetAll($routes);
        $this->routeGetByBoard($routes);
        $this->routeGetByIds($routes);
        $this->routeGetById($routes);
        $this->routeCreateThread($routes);
    }

    /**
     * Converts thread to JSON
     * @param Thread $thread
     * @return array
     */
    private function convertThreadToJSON(Thread $thread) {
        return [
            'id' => (string) $thread->getId()
        ];
    }

    /**
     * Route – GetAll
     * @param RouteCollection $routes
     */
    public function routeGetAll(RouteCollection $routes) {
        $routes->get('/backend/rest/thread', function (Request $request, Response $response, array $args) {
            $seek = new Seek(
                self::MAX_LIMIT,
                (int)$request->get('offset', 0),
                (int)$request->get('limit', self::DEFAULT_LIMIT)
            );

            $jsonResponse = [];
            $threads = $this->threadRepository->getAllThreadsWithSeek($seek);

            foreach ($threads as $thread) {
                $jsonResponse[] = $this->convertThreadToJSON($thread);
            }

            return new Ok($jsonResponse);
        });
    }

    /**
     * Route – GetByBoard
     * @param RouteCollection $routes
     */
    public function routeGetByBoard(RouteCollection $routes) {
        $routes->get('/backend/rest/thread/by-board/{boardId}', function (Request $request, Response $response, array $args) {
            $seek = new Seek(
                self::MAX_LIMIT,
                (int)$request->get('offset', 0),
                (int)$request->get('limit', self::DEFAULT_LIMIT)
            );

            $board = $this->boardRepository->getBoardById($args['boardId']);

            $threadsQuery = new ThreadListQuery($board, $seek);
            $threadsQuery->withAllPosts();

            $threadsQueryList = $this->threadRepository->getThreads($threadsQuery);
            $jsonResponse = [
                'items' => [],
                'total' => $threadsQueryList->getTotal()
            ];

            foreach ($threadsQueryList->getItems() as $thread) {
                $jsonResponse['items'][] = $this->convertThreadToJSON($thread);
            }

            return new Ok($jsonResponse);
        });
    }

    /**
     * Route – GetByIds
     * @param RouteCollection $routes
     */
    public function routeGetByIds(RouteCollection $routes) {
        $routes->get('/backend/rest/thread/by-ids/{ids}', function (Request $request, Response $response, array $args) {
            $jsonResponse = [];
            $threads = $this->threadRepository->getThreadsByIds(explode(',', $args['ids']));

            foreach ($threads->getThreads() as $thread) {
                $jsonResponse[] = $this->convertThreadToJSON($thread);
            }

            return new Ok($jsonResponse);
        });
    }

    /**
     * Route – GetById
     * @param RouteCollection $routes
     */
    public function routeGetById(RouteCollection $routes) {
        $routes->get('/backend/rest/thread/{id}', function (Request $request, Response $response, array $args) {
            try {
                $thread = $this->threadRepository->getThreadById($args['id']);
            } catch (\OutOfBoundsException $e) {
                throw new NotFoundException($e->getMessage());
            }

            return new Ok($this->convertThreadToJSON($thread));
        });
    }

    /**
     * @param RouteCollection $routes
     */
    public function routeCreateThread(RouteCollection $routes) {
        $routes->post('/backend/rest/thread/create/{boardId}', function (Request $request, Response $response, array $args) {
            $angularRequest = $angularRequest = json_decode($request->getContent(), true);
            $createPostFromRequest = new CreatePostFromRequest();
            $post = $createPostFromRequest->createPostFromRequest(null, $angularRequest['post']);

            $thread = $this->threadRepository->createNewThread($args['boardId'], $post);

            return new Ok($this->convertThreadToJSON($thread));
        });
    }
}