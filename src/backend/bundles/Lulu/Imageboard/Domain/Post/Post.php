<?php
namespace Lulu\Imageboard\Domain\Post;

class Post
{
    /**
     * Post Id
     * @var mixed
     */
    private $id;

    /**
     * Thread Id
     * @var mixed
     */
    private $threadId;

    /**
     * Content
     * @var string
     */
    private $content;

    /**
     * Post constructor.
     * @param mixed $id
     * @param mixed $threadId
     * @param string $content
     */
    public function __construct($id, $threadId, $content) {
        $this->id = $id;
        $this->threadId = $threadId;
        $this->content = $content;
    }


    /**
     * Returns post Id
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Thread Id
     * @return mixed
     */
    public function getThreadId() {
        return $this->threadId;
    }

    /**
     * Returns post content
     * @return string
     */
    public function getContent() {
        return $this->content;
    }
}