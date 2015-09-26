<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Domain\Repository;

use Doctrine\ORM\EntityManager;
use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\Domain\Entity\Thread;
use Lulu\Imageboard\Domain\Repository\Post\PostList;
use Lulu\Imageboard\Domain\Repository\Post\PostRepositoryInterface;
use Lulu\Imageboard\Util\Seek\SeekableInterface;

class PostRepository implements PostRepositoryInterface
{
    /**
     * Entity Manager
     * @var EntityManager
     */
    private $entityManager;

    /**
     * PostRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
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
    public function createPost(Post $post) {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function updatePost(Post $post) {
        throw new \Exception('Not implemented');
    }
}