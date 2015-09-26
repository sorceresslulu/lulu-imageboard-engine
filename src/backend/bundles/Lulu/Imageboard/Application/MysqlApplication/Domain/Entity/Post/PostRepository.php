<?php
namespace Lulu\Imageboard\Application\MysqlApplication\Domain\Entity\Post;

use Lulu\Imageboard\Domain\Entity\Post\Post;
use Lulu\Imageboard\Domain\Entity\Post\PostList;
use Lulu\Imageboard\Domain\Entity\Post\PostRepositoryInterface;
use Lulu\Imageboard\Domain\Entity\Thread\Thread;
use Lulu\Imageboard\Util\Seek\SeekableInterface;

class PostRepository implements PostRepositoryInterface
{
    /**
     * Mysqli
     * @var \mysqli
     */
    private $mysqli;

    /**
     * PostRepository constructor.
     * @param \mysqli $mysqli
     */
    public function __construct(\mysqli $mysqli) {
        $this->mysqli = $mysqli;
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