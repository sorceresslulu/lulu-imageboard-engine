<?php
namespace Lulu\Imageboard\Repository\Mongo;

use Lulu\Imageboard\Domain\Board\Board;
use Lulu\Imageboard\Domain\Thread\Factory\BoardPrototypeFactoryInterface;
use Lulu\Imageboard\Domain\Thread\Thread;
use Lulu\Imageboard\Domain\Thread\ThreadRepositoryInterface;
use Lulu\Imageboard\Util\Seek\SeekableInterface;

class ThreadRepository implements ThreadRepositoryInterface
{
    /**
     * Threads mongo collection
     * @var \MongoCollection
     */
    private $threadMongoCollection;

    /**
     * Board prototype factory
     * @var BoardPrototypeFactoryInterface
     */
    private $boardPrototypeFactory;

    /**
     * ThreadRepository constructor.
     * @param \MongoCollection $threadMongoCollection
     * @param BoardPrototypeFactoryInterface $boardPrototypeFactory
     */
    public function __construct(\MongoCollection $threadMongoCollection, BoardPrototypeFactoryInterface $boardPrototypeFactory) {
        $this->threadMongoCollection = $threadMongoCollection;
        $this->boardPrototypeFactory = $boardPrototypeFactory;
    }

    /**
     * @inheritDoc
     */
    public function getAllThreads() {
        $threads = [];

        foreach($this->threadMongoCollection->find([]) as $threadBSON) {
            $threads[] = $this->createThreadFromBSON($threadBSON);
        }

        return $threads;
    }

    /**
     * @inheritDoc
     */
    public function getAllThreadsWithSeek(SeekableInterface $seek) {
        $threads = [];

        $cursor = $this->threadMongoCollection->find([]);
        $cursor->skip($seek->getOffset());
        $cursor->limit($seek->getLimit());

        foreach($cursor as $threadBSON) {
            $threads[] = $this->createThreadFromBSON($threadBSON);
        }

        return $threads;
    }

    /**
     * @inheritDoc
     */
    public function getThreadsByBoard(Board $board, SeekableInterface $seek) {
        $threads = [];

        $cursor = $this->threadMongoCollection->find([
            'board_id' => new \MongoId($board->getId())
        ]);
        $cursor->skip($seek->getOffset());
        $cursor->limit($seek->getLimit());

        foreach($cursor as $threadBSON) {
            $threads[] = $this->createThreadFromBSON($threadBSON);
        }

        return $threads;
    }

    /**
     * @inheritDoc
     */
    public function getThreadById($threadId) {
        $thread = $this->threadMongoCollection->findOne(['_id' => new \MongoId($threadId)]);

        if(!($thread)) {
            throw new \OutOfBoundsException(sprintf('Thread with Id `%s` not found', $threadId));
        }

        return $this->createThreadFromBSON($thread);
    }

    /**
     * Create and returns thread from threadBSON
     * @param array $threadBSON
     * @return Thread
     */
    private function createThreadFromBSON(array $threadBSON) {
        return new Thread(
            $threadBSON['_id'],
            $this->boardPrototypeFactory->getBoardById($threadBSON['board_id'])
        );
    }
}