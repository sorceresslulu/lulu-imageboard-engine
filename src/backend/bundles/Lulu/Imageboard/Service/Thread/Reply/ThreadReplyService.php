<?php
namespace Lulu\Imageboard\Service\Thread\Reply;

use Lulu\Imageboard\Domain\Repository\PostRepositoryInterface;
use Lulu\Imageboard\Domain\Repository\ThreadRepositoryInterface;

class ThreadReplyService
{
    /**
     * Thread Repository
     * @var ThreadRepositoryInterface
     */
    private $threadRepository;

    /**
     * Post Repository
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * ThreadReplyService constructor.
     * @param ThreadRepositoryInterface $threadRepository
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(ThreadRepositoryInterface $threadRepository, PostRepositoryInterface $postRepository) {
        $this->threadRepository = $threadRepository;
        $this->postRepository = $postRepository;
    }

    /**
     * Reply to thread
     * @param ThreadReplyQuery $replyQuery
     * @throws \Exception
     */
    public function reply(ThreadReplyQuery $replyQuery)
    {
        $thread = $this->threadRepository->getThreadById($replyQuery->getThreadId());
        $replyQuery->getPost()->setThread($thread);

        $this->postRepository->createPost($replyQuery->getPost());
    }
}