<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Doctrine\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="thread")
 */
class Thread
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
     * Board
     * @OneToOne(targetEntity="Lulu\Imageboard\Application\DoctrineApplication\Doctrine\Entity\Board")
     * @JoinColumn(name="board_id", referencedColumnName="id")
     * @var Board
     */
    protected $board;

    /**
     * Date Created On
     * @Column(type="datetime")
     * @var \DateTime
     */
    protected $dateCreatedOn;

    /**
     * Date Updated On
     * @Column(type="datetime")
     * @var \DateTime
     */
    protected $dateUpdatedOn;

    /**
     * Posts
     * @OneToMany(targetEntity="Lulu\Imageboard\Application\DoctrineApplication\Doctrine\Entity\Post", mappedBy="thread")
     * @var ArrayCollection
     */
    protected $posts;

    public function __construct() {
        $this->posts = new ArrayCollection();
    }

    /**
     * Returns id
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Returns board
     * @return Board
     */
    public function getBoard() {
        return $this->board;
    }

    /**
     * Set board
     * @param Board $board
     */
    public function setBoard(Board $board) {
        $this->board = $board;
    }

    /**
     * Returns date created on
     * @return \DateTime
     */
    public function getDateCreatedOn() {
        return $this->dateCreatedOn;
    }

    /**
     * Set date updated on
     * @param \DateTime $dateCreatedOn
     */
    public function setDateCreatedOn($dateCreatedOn) {
        $this->dateCreatedOn = $dateCreatedOn;
    }

    /**
     * Returns date updated on
     * @return \DateTime
     */
    public function getDateUpdatedOn() {
        return $this->dateUpdatedOn;
    }

    /**
     * Set date updated on
     * @param \DateTime $dateUpdatedOn
     */
    public function setDateUpdatedOn($dateUpdatedOn) {
        $this->dateUpdatedOn = $dateUpdatedOn;
    }

    /**
     * Returns posts
     * @return ArrayCollection
     */
    public function getPosts() {
        return $this->posts;
    }

    /**
     * Set posts
     * @param ArrayCollection $posts
     */
    public function setPosts($posts) {
        $this->posts = $posts;
    }
}