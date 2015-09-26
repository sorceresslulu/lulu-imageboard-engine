<?php
namespace Lulu\Imageboard\Service\REST;

use League\Route\Http\Exception\NotFoundException;
use League\Route\Http\JsonResponse\Ok;
use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\Domain\Repository\PostRepositoryInterface;
use Lulu\Imageboard\Service\REST\Component\PostFormatter;
use Lulu\Imageboard\Service\REST\Component\PostFormatterInterface;

class PostRESTService
{
    const MAX_LIMIT = 1000;
    const DEFAULT_LIMIT = 10;

    /**
     * Post Repository
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
     * Create post
     * @throws \Exception
     */
    public function createPost() {
        throw new \Exception('Not implemented');
    }

    /**
     * Returns post by Id
     * @param $id
     * @return Ok
     * @throws NotFoundException
     */
    public function getById($id) {
        try {
            $post = $this->postRepository->getPostById($id);
        } catch (\OutOfBoundsException $e) {
            throw new NotFoundException($e->getMessage());
        }

        return new Ok($this->postToJSON($post));
    }

    /**
     * Returns posts by Ids
     * @param array $threadIds
     * @return Ok
     * @throws \Exception
     */
    public function getByIds(array $threadIds) {
        $jsonResponse = [];

        if (count($ids = $threadIds) > self::MAX_LIMIT) {
            throw new \Exception(sprintf('Too much posts requested, expected max to %d, got %d', self::MAX_LIMIT, count($ids)));
        }

        foreach ($this->postRepository->getPostsByIds($ids) as $post) {
            $jsonResponse[] = $this->postToJSON($post);
        }

        return new Ok($jsonResponse);
    }

    /**
     * Returns all posts of thread
     * @param $threadId
     * @return Ok
     * @throws NotFoundException
     */
    public function getByThreadId($threadId) {
        $jsonResponse = [];

        try {
            $posts = $this->postRepository->getPostsByThreadId($threadId);
        } catch (\OutOfBoundsException $e) {
            throw new NotFoundException($e->getMessage());
        }

        foreach ($posts as $post) {
            $jsonResponse[] = $this->postToJSON($post);
        }

        return new Ok($jsonResponse);
    }

    /**
     * It should be called somehow like "ThreadFeedThreadFeedFormatter"
     * @param Post $post
     * @return array
     */
    private function postToJSON(Post $post) {
        return $this->postFormatter->format($post);
    }
}