<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Domain\Repository;

use Lulu\Imageboard\Application\DoctrineApplication\Domain\Repositories;
use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\Domain\Entity\Thread;
use Lulu\Imageboard\Domain\Repository\PostRepositoryInterface;
use Lulu\Imageboard\Util\Seek\SeekableInterface;

class PostRepository implements PostRepositoryInterface
{
    /**
     * Repositories
     * @var Repositories
     */
    private $repositories;

    /**
     * PostRepository constructor.
     * @param Repositories $repositories
     */
    public function __construct(Repositories $repositories) {
        $this->repositories = $repositories;
    }

    /**
     * @inheritDoc
     */
    public function getAllPosts() {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function getAllPostsWithSeek(SeekableInterface $seek) {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function getPostsOfThread(Thread $thread) {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function getPostsByThreadId($threadId) {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function getPostById($id) {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function getPostsByIds(array $ids) {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function createPost($threadId, array $params) {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function updatePost(Post $post) {
        throw new \Exception('Not implemented');
    }
}