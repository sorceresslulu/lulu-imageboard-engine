<?php
namespace Lulu\Imageboard\Domain\Entity;

/**
 * @Entity
 * @Table(name="post")
 */
class Post
{
    /**
     * Id
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * Thread
     * @ManyToOne(targetEntity="Lulu\Imageboard\Domain\Entity\Thread", inversedBy="posts")
     * @JoinColumn(name="thread_id", referencedColumnName="id")
     * @var Thread
     */
    protected $thread;

    /**
     * Created On
     * @Column(type="datetime")
     * @var \DateTime
     */
    protected $dateCreatedOn;

    /**
     * Updated On
     * @Column(type="datetime")
     * @var \DateTime
     */
    protected $dateUpdatedOn;

    /**
     * Author
     * @Column(type="string")
     * @var string
     */
    protected $author;

    /**
     * E-mail
     * @Column(type="string")
     * @var string
     */
    protected $email;

    /**
     * Content
     * @Column(type="text")
     * @var string
     */
    protected $content;

    /**
     * Post constructor.
     */
    public function __construct() {
        $this->dateCreatedOn = new \DateTime();
        $this->dateUpdatedOn = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Returns thread
     * @return Thread
     */
    public function getThread() {
        return $this->thread;
    }

    /**
     * Set thread
     * @param Thread $thread
     */
    public function setThread($thread) {
        $this->thread = $thread;
    }

    /**
     * Returns created on
     * @return \DateTime
     */
    public function getDateCreatedOn() {
        return $this->dateCreatedOn;
    }

    /**
     * Set created on
     * @param \DateTime $dateCreatedOn
     */
    public function setDateCreatedOn($dateCreatedOn) {
        $this->dateCreatedOn = $dateCreatedOn;
    }

    /**
     * Returns updated on
     * @return \DateTime
     */
    public function getDateUpdatedOn() {
        return $this->dateUpdatedOn;
    }

    /**
     * Set updated on
     * @param \DateTime $dateUpdatedOn
     */
    public function setDateUpdatedOn($dateUpdatedOn) {
        $this->dateUpdatedOn = $dateUpdatedOn;
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
     */
    public function setAuthor($author) {
        $this->author = $author;
    }

    /**
     * Returns  email
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set email
     * @param string $email
     */
    public function setEmail($email) {
        $this->email = $email;
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
     */
    public function setContent($content) {
        $this->content = $content;
    }
}