<?php
namespace Lulu\Imageboard\REST\Thread;

use League\Route\Http\Exception\NotFoundException;
use League\Route\Http\JsonResponse\Ok;
use League\Route\RouteCollection;
use Lulu\Imageboard\Domain\Thread\Thread;
use Lulu\Imageboard\Domain\Thread\ThreadRepositoryInterface;
use Lulu\Imageboard\Repository\Mongo\BoardRepository\Factory\BoardPrototypeFactory;
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
     * @var BoardPrototypeFactory
     */
    private $boardPrototypeFactory;

    /**
     * ThreadRESTService constructor.
     * @param ThreadRepositoryInterface $threadRepository
     * @param BoardPrototypeFactory $boardPrototypeFactory
     */
    public function __construct(ThreadRepositoryInterface $threadRepository, BoardPrototypeFactory $boardPrototypeFactory) {
        $this->threadRepository = $threadRepository;
        $this->boardPrototypeFactory = $boardPrototypeFactory;
    }

    /**
     * @inheritdoc
     */
    public function initRoutes(RouteCollection $routes) {
        $routes->get('/backend/rest/thread/', function(Request $request, Response $response, array $args) {
            $seek = new Seek(
                self::MAX_LIMIT,
                (int) $request->get('offset', 0),
                (int) $request->get('limit', self::DEFAULT_LIMIT)
            );

            $jsonResponse = [];
            $threads = $this->threadRepository->getAllThreadsWithSeek($seek);

            foreach($threads as $thread) {
                $jsonResponse[] = $this->convertThreadToJSON($thread);
            }

            return new Ok($jsonResponse);
        });

        $routes->get('/backend/rest/thread/by-board/{boardId}', function(Request $request, Response $response, array $args) {
            $seek = new Seek(
                self::MAX_LIMIT,
                (int) $request->get('offset', 0),
                (int) $request->get('limit', self::DEFAULT_LIMIT)
            );

            $board = $this->boardPrototypeFactory->getBoardById($args['boardId']);

            $jsonResponse = [];
            $threads = $this->threadRepository->getThreadsByBoard($board, $seek);

            foreach($threads as $thread) {
                $jsonResponse[] = $this->convertThreadToJSON($thread);
            }

            return new Ok($jsonResponse);
        });

        $routes->get('/backend/rest/thread/by-ids/{ids}', function(Request $request, Response $response, array $args) {
            $jsonResponse = [];
            $threads = $this->threadRepository->getThreadsByIds(explode(',', $args['ids']));

            foreach($threads as $thread) {
                $jsonResponse[] = $this->convertThreadToJSON($thread);
            }

            return new Ok($jsonResponse);
        });

        $routes->get('/backend/rest/thread/{id}', function(Request $request, Response $response, array $args) {
            try {
                $thread = $this->threadRepository->getThreadById($args['id']);
            }catch(\OutOfBoundsException $e)  {
                throw new NotFoundException($e->getMessage());
            }

            return new Ok($this->convertThreadToJSON($thread));
        });
    }

    /**
     * Converts thread to JSON
     * @param Thread $thread
     * @return array
     */
    private function convertThreadToJSON(Thread $thread) {
        return [
            'id' => $thread->getId(),
            'board' => [
                'id' => $thread->getBoard()->getId(),
                'title' => $thread->getBoard()->getTitle()
            ]
        ];
    }
}