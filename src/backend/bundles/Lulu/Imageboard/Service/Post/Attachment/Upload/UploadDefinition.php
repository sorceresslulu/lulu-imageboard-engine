<?php
namespace Lulu\Imageboard\Service\Post\Attachment\Upload;

use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\Service\Upload\Component\UploadRequest;

class UploadDefinition
{
    /**
     * Post
     * @var Post
     */
    private $post;

    /**
     * Upload Request
     * @var UploadRequest
     */
    private $uploadRequest;

    /**
     * UploadDefinition constructor.
     * @param Post $post
     * @param UploadRequest $uploadRequest
     */
    public function __construct(Post $post, UploadRequest $uploadRequest) {
        $this->post = $post;
        $this->uploadRequest = $uploadRequest;
    }

    /**
     * @return Post
     */
    public function getPost() {
        return $this->post;
    }

    /**
     * @return UploadRequest
     */
    public function getUploadRequest() {
        return $this->uploadRequest;
    }
}