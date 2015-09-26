<?php
namespace Lulu\Imageboard\Domain\Thread;

use Lulu\Imageboard\Domain\Board\Board;
use Lulu\Imageboard\Domain\Post\Post;
use Lulu\Imageboard\Domain\Thread\Component\ThreadListQuery;
use Lulu\Imageboard\Util\QueryList;
use Lulu\Imageboard\Util\Seek\SeekableInterface;

interface ThreadRepositoryInterface
{
    /**
     * Returns threads by board
     * Query is limited by seek
     * @param ThreadListQuery $threadListQuery
     * @return QueryList
     */
    public function getThreads(ThreadListQuery $threadListQuery);

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

    /**
     * Create new thread
     * @param $boardId
     * @param Post $post
     * @return Thread
     */
    public function createNewThread($boardId, Post $post);
}