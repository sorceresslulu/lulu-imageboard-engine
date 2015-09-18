<?php
namespace Lulu\Imageboard\REST\Thread;

use League\Route\Http\Exception\NotFoundException;
use League\Route\Http\JsonResponse\Ok;
use League\Route\RouteCollection;
use Lulu\Imageboard\Domain\Post\PostRepositoryInterface;
use Lulu\Imageboard\Domain\Thread\ThreadRepositoryInterface;
use Lulu\Imageboard\REST\RESTServiceInterface;
use Lulu\Imageboard\REST\Thread\ThreadFeedRESTService\Formatter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ThreadFeedRESTService implements RESTServiceInterface
{
    /**
     * Thread Repository
     * @var ThreadRepositoryInterface
     */
    private $threadRepository;

    /**
     * Post Repository
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * ThreadFeedRESTService constructor.
     * @param ThreadRepositoryInterface $threadRepository
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(ThreadRepositoryInterface $threadRepository, PostRepositoryInterface $postRepository) {
        $this->threadRepository = $threadRepository;
        $this->postRepository = $postRepository;
    }

    /**
     * @inheritdoc
     */
    public function initRoutes(RouteCollection $routes) {
        $this->routeGetFeed($routes);
    }

    /**
     * Route – GetFeed
     * @param RouteCollection $routes
     */
    public function routeGetFeed(RouteCollection $routes) {
        $routes->get('/backend/rest/thread/feed/{threadId}', function (Request $request, Response $response, array $args) {
            try {
                $thread = $this->threadRepository->getThreadById($args['threadId']);
                $posts = $this->postRepository->getPostsOfThread($thread);

                $formatter = new Formatter();

                return new Ok($formatter->format($thread, $posts));
            } catch (\OutOfBoundsException $e) {
                throw new NotFoundException($e->getMessage());
            }
        });
    }
}