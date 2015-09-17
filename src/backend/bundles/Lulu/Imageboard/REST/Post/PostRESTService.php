<?php
namespace Lulu\Imageboard\REST\Post;

use League\Route\Http\JsonResponse\Ok;
use League\Route\RouteCollection;
use Lulu\Imageboard\Domain\Post\Post;
use Lulu\Imageboard\Domain\Post\PostRepositoryInterface;
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
     * PostRESTService constructor.
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository) {
        $this->postRepository = $postRepository;
    }

    /**
     * @inheritdoc
     */
    public function initRoutes(RouteCollection $routes) {
        $routes->get('/backend/rest/post/', function(Request $request, Response $response) {
            $jsonResponse = [];
            $seekFromRequest = new SeekFromRequest($request, self::MAX_LIMIT, self::DEFAULT_LIMIT);

            foreach($this->postRepository->getAllPostsWithSeek($seekFromRequest)->getPosts() as $post) {
                $jsonResponse[] = $this->postToJSON($post);
            }

            return new Ok($jsonResponse);
        });
    }

    /**
     * It should be called somehow like "Formatter"
     * @param Post $post
     * @return array
     */
    private function postToJSON(Post $post) {
        return [
            'id' => $post->getId(),
            'thread_id' => $post->getThreadId(),
            'content' => $post->getContent()
        ];
    }
}