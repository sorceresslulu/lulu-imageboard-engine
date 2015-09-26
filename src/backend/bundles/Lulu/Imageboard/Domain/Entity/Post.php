<?php
namespace Lulu\Imageboard\Domain\Entity;

class Post
{
    /**
     * Post Id
     * @var mixed
     */
    private $id;

    /**
     * Thread
     * @var Thread
     */
    private $thread;

    /**
     * Author
     * @var string
     */
    private $author;

    /**
     * Email
     * @var string
     */
    private $email;

    /**
     * Content
     * @var string
     */
    private $content;

    /**
     * Post constructor.
     * @param mixed $id
     */
    public function __construct($id = null) {
        $this->id = $id;
    }

    /**
     * Returns post Id
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Define Id for this post
     * @param $id
     * @throws \Exception
     */
    public function defineId($id) {
        if($this->isIdDefined()) {
            throw new \Exception('Id is already defined');
        }

        $this->id = $id;
    }

    /**
     * Returns true if Id for this post is defined
     * @return bool
     */
    public function isIdDefined() {
        return $this->id !== null;
    }

    /**
     * Returns thread
     * @return \Lulu\Imageboard\Domain\Entity\Thread
     */
    public function getThread() {
        return $this->thread;
    }

    /**
     * Set thread
     * @param \Lulu\Imageboard\Domain\Entity\Thread $thread
     */
    public function setThread($thread) {
        $this->thread = $thread;
    }

    /**
     * Returns author
     * @return string
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * Set author
     * @param string $author
     * @return $this
     */
    public function setAuthor($author) {
        $this->author = $author;

        return $this;
    }

    /**
     * Returns email
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set email
     * @param string $email
     * @return $this
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Returns content
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set content
     * @param string $content
     * @return $this
     */
    public function setContent($content) {
        $this->content = $content;

        return $this;
    }
}