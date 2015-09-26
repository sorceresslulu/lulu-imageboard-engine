<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Domain\Repository;

use Doctrine\ORM\EntityManager;
use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\Domain\Entity\Thread;
use Lulu\Imageboard\Domain\Repository\Thread\Component\ThreadListQuery;
use Lulu\Imageboard\Domain\Repository\Thread\ThreadRepositoryInterface;
use Lulu\Imageboard\Util\QueryList;

class ThreadRepository implements ThreadRepositoryInterface
{
    /**
     * Entity Manager
     * @var EntityManager
     */
    private $entityManager;

    /**
     * ThreadRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
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