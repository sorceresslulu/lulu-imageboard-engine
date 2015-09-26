<?php
namespace Lulu\Imageboard\Application\MysqlApplication\Domain\Entity\Thread;

use Lulu\Imageboard\Domain\Entity\Post\Post;
use Lulu\Imageboard\Domain\Entity\Thread\Component\ThreadListQuery;
use Lulu\Imageboard\Domain\Entity\Thread\Thread;
use Lulu\Imageboard\Domain\Entity\Thread\ThreadRepositoryInterface;
use Lulu\Imageboard\Util\QueryList;

class ThreadRepository implements ThreadRepositoryInterface
{
    /**
     * Mysqli
     * @var \mysqli
     */
    private $mysqli;

    /**
     * ThreadRepository constructor.
     * @param \mysqli $mysqli
     */
    public function __construct(\mysqli $mysqli) {
        $this->mysqli = $mysqli;
    }

    /**
     * @inheritDoc
     */
    public function getThreads(ThreadListQuery $threadListQuery) {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function getThreadById($threadId) {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function getThreadsByIds(array $threadIds) {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function createNewThread($boardId, Post $post) {
        throw new \Exception('Not implemented');
    }
}