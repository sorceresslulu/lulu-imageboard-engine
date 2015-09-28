<?php
namespace Lulu\Imageboard\Service\REST;

use League\Route\Http\Exception\NotFoundException;
use League\Route\Http\JsonResponse\Ok;
use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\Domain\Repository\Post\PostQuery;
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
     * Returns posts by query
     * @param PostQuery $postQuery
     * @return array
     */
    public function getPostsByQuery(PostQuery $postQuery) {
        $jsonResponse = [];

        foreach($this->postRepository->getPosts($postQuery) as $post) {
            $jsonResponse[] = $this->postToJSON($post);
        }

        return new Ok($jsonResponse);
    }

    /**
     * It should be called somehow like "ThreadFeedFormatter"
     * @param Post $post
     * @return array
     */
    private function postToJSON(Post $post) {
        return $this->postFormatter->format($post);
    }
}