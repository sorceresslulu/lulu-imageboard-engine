<?php
namespace Lulu\Imageboard\Service\Thread\Reply;

use Lulu\Imageboard\Domain\Entity\Post;

class ThreadReplyQuery
{
    /**
     * Thread Id
     * @var int
     */
    private $threadId;

    /**
     * Post
     * @var Post
     */
    private $post;

    /**
     * ThreadReplyQuery constructor.
     * @param int $threadId
     * @param Post $post
     */
    public function __construct($threadId, Post $post) {
        $this->threadId = $threadId;
        $this->post = $post;
    }

    /**
     * Returns thread Id
     * @return int
     */
    public function getThreadId() {
        return $this->threadId;
    }

    /**
     * Returns post
     * @return Post
     */
    public function getPost() {
        return $this->post;
    }
}