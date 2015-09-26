<?php
namespace Lulu\Imageboard\Domain\Entity;

use Lulu\Imageboard\Domain\Repository\Post\PostList;
use Lulu\Imageboard\Util\DateMarks;
use Lulu\Imageboard\Util\Id;

class Thread
{
    /**
     * Thread Id
     * @var Id
     */
    private $id;

    /**
     * Board Id
     * @var Id
     */
    private $boardId;

    /**
     * Date marks
     * @var DateMarks
     */
    private $dateMarks;

    /**
     * Posts List
     * @var PostList
     */
    private $posts;

    /**
     * Thread constructor.
     * @param Id $id
     * @param Id $boardId
     */
    public function __construct(Id $id = null, Id $boardId = null) {
        if($id === null) {
            $id = new Id();
        }

        if($boardId === null) {
            $boardId = new Id();
        }

        $this->id = $id;
        $this->boardId = $boardId;
        $this->dateMarks = new DateMarks();
    }

    /**
     * Returns Id
     * @return Id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Returns Board Id
     * @return Id
     */
    public function getBoardId() {
        return $this->boardId;
    }

    /**
     * Returns Date Marks
     * @return DateMarks
     */
    public function getDateMarks() {
        return $this->dateMarks;
    }

    /**
     * Returns posts list
     * @return PostList
     */
    public function getPosts() {
        return $this->posts;
    }

    /**
     * Set posts list
     * @param PostList $posts
     */
    public function setPosts(PostList $posts) {
        $this->posts = $posts;
    }
}