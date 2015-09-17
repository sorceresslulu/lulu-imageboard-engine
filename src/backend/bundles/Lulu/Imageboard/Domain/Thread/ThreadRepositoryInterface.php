<?php
namespace Lulu\Imageboard\Domain\Thread;

use Lulu\Imageboard\Domain\Board\Board;
use Lulu\Imageboard\Util\Seek\SeekableInterface;

interface ThreadRepositoryInterface
{
    /**
     * Returns all threads
     * @return Thread[]
     */
    public function getAllThreads();

    /**
     * Returns all threads
     * Query is limited by seek
     * @param SeekableInterface $seek
     * @return Thread[]
     */
    public function getAllThreadsWithSeek(SeekableInterface $seek);

    /**
     * Returns threads by board
     * Query is limited by seek
     * @param Board $board
     * @param SeekableInterface $seek
     * @return mixed
     */
    public function getThreadsByBoard(Board $board, SeekableInterface $seek);

    /**
     * Returns thread by Id
     * @param $threadId
     * @return Thread
     */
    public function getThreadById($threadId);

    /**
     * Returns threads by Ids
     * @param array $threadIds
     * @return Thread[]
     */
    public function getThreadsByIds(array $threadIds);
}