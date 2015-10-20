<?php
namespace Lulu\Imageboard\Service\Post\Attachment\Upload;

use Lulu\Imageboard\Domain\Entity\Post;

class Query
{
    /**
     * Post
     * @var Post
     */
    private $post;

    /**
     * @var UploadDefinition[]
     */
    private $definitions;

    /**
     * Query constructor.
     * @param Post $post
     * @param UploadDefinition[] $definitions
     */
    public function __construct(Post $post, array $definitions) {
        $this->post = $post;
        $this->definitions = $definitions;
    }

    /**
     * Validate
     * @throws \Exception
     */
    public function validate() {
        foreach($this->definitions as $definition) {
            $definition->getUploadRequest()->getHandler()->validate();
        }
    }

    /**
     * Process upload
     * @throws \Exception
     */
    public function process() {
        foreach($this->definitions as $definition) {
            $definition->getUploadRequest()->getHandler()->process();
        }
    }
}