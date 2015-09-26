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
     * Board
     * @var Board
     */
    private $board;

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
     */
    public function __construct(Id $id = null) {
        if($id === null) {
            $id = new Id();
        }

        $this->id = $id;
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
    public function setBoard($board) {
        $this->board = $board;
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