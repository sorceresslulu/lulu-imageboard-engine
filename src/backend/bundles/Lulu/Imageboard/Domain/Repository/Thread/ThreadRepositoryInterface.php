<?php
namespace Lulu\Imageboard\Domain\Repository\Thread;

use Lulu\Imageboard\Domain\Entity\Board;
use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\Domain\Repository\Thread\Component\ThreadListQuery;
use Lulu\Imageboard\Domain\Entity\Thread;
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
     * @return ThreadList
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