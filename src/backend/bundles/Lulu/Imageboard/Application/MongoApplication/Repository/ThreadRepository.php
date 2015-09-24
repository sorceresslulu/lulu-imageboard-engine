<?php
namespace Lulu\Imageboard\Application\MongoApplication\Repository;

use Lulu\Imageboard\Domain\Board\Board;
use Lulu\Imageboard\Domain\Post\Post;
use Lulu\Imageboard\Domain\Post\PostRepositoryInterface;
use Lulu\Imageboard\Domain\Thread\Thread;
use Lulu\Imageboard\Domain\Thread\ThreadRepositoryInterface;
use Lulu\Imageboard\Util\Id;
use Lulu\Imageboard\Util\Seek\SeekableInterface;

class ThreadRepository implements ThreadRepositoryInterface
{
    /**
     * Threads mongo collection
     * @var \MongoCollection
     */
    private $threadMongoCollection;

    /**
     * Post Repository
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * ThreadRepository constructor.
     * @param \MongoCollection $threadMongoCollection
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(\MongoCollection $threadMongoCollection, PostRepositoryInterface $postRepository) {
        $this->threadMongoCollection = $threadMongoCollection;
        $this->postRepository = $postRepository;
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
     * @inheritDoc
     */
    public function getThreadsByIds(array $threadIds) {
        $threads = [];

        foreach($this->threadMongoCollection->find([
            '_id' => [
                '$in' => array_map(function(&$input) {
                    return new \MongoId($input);
                }, $threadIds)
            ]
        ]) as $threadBSON) {
            $threads[] = $this->createThreadFromBSON($threadBSON);
        }

        return $threads;
    }


    /**
     * Create and returns thread from threadBSON
     * @param array $threadBSON
     * @return Thread
     */
    private function createThreadFromBSON(array $threadBSON) {
        return new Thread(new Id($threadBSON['_id']), new Id(
            new \MongoId($threadBSON['board_id'])
        ));
    }

    /**
     * Create and returns Thread's BSON
     * @param Thread $thread
     * @return array
     * @throws \Exception
     */
    private function createBSONFromThread(Thread $thread) {
        $postBSON = [
            '_id' => $thread->getId()->isIdDefined() ? $thread->getId() : new \MongoId(),
            'board_id' => $thread->getBoardId()->getIdValue(),
            'created_on' => $thread->getDateMarks()->getCreatedOn(),
        ];

        if($thread->getDateMarks()->wasUpdated()) {
            $postBSON['updated_on'] = $thread->getDateMarks()->getUpdatedOn();
        }

        return $postBSON;
    }

    /**
     * @inheritDoc
     */
    public function createNewThread($boardId, Post $post) {
        $thread = new Thread();
        $thread->getBoardId()->defineId(new \MongoId($boardId));

        $threadBSON = $this->createBSONFromThread($thread);
        $this->threadMongoCollection->insert($threadBSON);

        $thread->getId()->defineId($threadBSON['_id']);

        $post->setThreadId($thread->getId()->getIdValue());

        $this->postRepository->createPost($post);

        return $thread;
    }
}