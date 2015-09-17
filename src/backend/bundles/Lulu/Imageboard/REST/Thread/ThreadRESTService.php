<?php
namespace Lulu\Imageboard\REST\Thread;

use League\Route\Http\Exception\NotFoundException;
use League\Route\Http\JsonResponse\Ok;
use League\Route\RouteCollection;
use Lulu\Imageboard\Domain\Thread\Thread;
use Lulu\Imageboard\Domain\Thread\ThreadRepositoryInterface;
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
     * ThreadRESTService constructor.
     * @param ThreadRepositoryInterface $threadRepository
     */
    public function __construct(ThreadRepositoryInterface $threadRepository) {
        $this->threadRepository = $threadRepository;
    }

    /**
     * @inheritdoc
     */
    public function initRoutes(RouteCollection $routes) {
        $routes->get('/backend/rest/thread/', function(Request $request, Response $response, array $args) {
            $seek = new Seek(
                self::MAX_LIMIT,
                isset($args['offset']) ? $args['offset'] : 0,
                isset($args['limit']) ? $args['limit'] : self::DEFAULT_LIMIT
            );

            $jsonResponse = [];
            $threads = $this->threadRepository->getAllThreadsWithSeek($seek);

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