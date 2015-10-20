<?php
namespace Lulu\Imageboard\Service\Thread\Reply;

use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\Util\RequestFile;

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
     * Request Files
     * @var RequestFile[]
     */
    private $uploadFiles = [];

    /**
     * ThreadReplyQuery constructor.
     * @param int $threadId
     * @param Post $post
     * @param \Lulu\Imageboard\Util\RequestFile[] $uploadFiles
     */
    public function __construct($threadId, Post $post, array $uploadFiles) {
        $this->threadId = $threadId;
        $this->post = $post;
        $this->uploadFiles = $uploadFiles;
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

    /**
     * Returns upload files
     * @return \Lulu\Imageboard\Util\RequestFile[]
     */
    public function getUploadFiles() {
        return $this->uploadFiles;
    }
}