<?php
namespace Lulu\Imageboard\REST\Post;

use League\Route\Http\Exception\NotFoundException;
use League\Route\Http\JsonResponse\Ok;
use League\Route\RouteCollection;
use Lulu\Imageboard\REST\Post\Formatter\PostFormatter;
use Lulu\Imageboard\REST\Post\Formatter\PostFormatterInterface;
use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\Domain\Repository\PostRepositoryInterface;
use Lulu\Imageboard\REST\Post\Util\CreatePostFromRequest;
use Lulu\Imageboard\REST\RESTServiceInterface;
use Lulu\Imageboard\Util\Seek\SeekFromRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostRESTService implements RESTServiceInterface
{
    const MAX_LIMIT = 1000;
    const DEFAULT_LIMIT = 10;

    /**
     * Post repository
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * Post formatter
     * @var PostFormatterInterface
     */
    private $postFormatter;

    /**
     * PostRESTService constructor.
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository) {
        $this->postRepository = $postRepository;
        $this->postFormatter = new PostFormatter();
    }

    /**
     * @inheritdoc
     */
    public function initRoutes(RouteCollection $routes) {
        $this->routeGetById($routes);
        $this->routeGetByIds($routes);
        $this->routeGetByThreadId($routes);
        $this->postCreatePost($routes);
    }

    /**
     * It should be called somehow like "Formatter"
     * @param Post $post
     * @return array
     */
    private function postToJSON(Post $post) {
        return $this->postFormatter->format($post);
    }

    /**
     * Route – GetById
     * @param RouteCollection $routes
     */
    public function routeGetById(RouteCollection $routes) {
        $routes->get('/backend/rest/post/{id}', function (Request $request, Response $response, array $args) {
            try {
                $post = $this->postRepository->getPostById($args['id']);
            } catch (\OutOfBoundsException $e) {
                throw new NotFoundException($e->getMessage());
            }

            return new Ok($this->postToJSON($post));
        });
    }

    /**
     * Route – GetByIds
     * @param RouteCollection $routes
     */
    public function routeGetByIds(RouteCollection $routes) {
        $routes->get('/backend/rest/post/by-ids/{ids}', function (Request $request, Response $response, array $args) {
            $jsonResponse = [];

            if (count($ids = explode(',', $args['ids'])) > self::MAX_LIMIT) {
                throw new \Exception(sprintf('Too much posts requested, expected max to %d, got %d', self::MAX_LIMIT, count($ids)));
            }

            foreach ($this->postRepository->getPostsByIds($ids) as $post) {
                $jsonResponse[] = $this->postToJSON($post);
            }

            return new Ok($jsonResponse);
        });
    }

    /**
     * Route – GetByThreadId
     * @param RouteCollection $routes
     */
    public function routeGetByThreadId(RouteCollection $routes) {
        $routes->get('/backend/rest/post/by-thread/{threadId}', function (Request $request, Response $response, array $args) {
            $jsonResponse = [];

            try {
                $posts = $this->postRepository->getPostsByThreadId($args['threadId']);
            } catch (\OutOfBoundsException $e) {
                throw new NotFoundException($e->getMessage());
            }

            foreach ($posts as $post) {
                $jsonResponse[] = $this->postToJSON($post);
            }

            return new Ok($jsonResponse);
        });
    }

    /**
     * Route – PutPost
     * @param RouteCollection $routes
     */
    public function postCreatePost(RouteCollection $routes) {
        $routes->post('/backend/rest/post/create/{threadId}', function (Request $request, Response $response, array $args) {
            throw new \Exception('Not implemented');
        });
    }
}