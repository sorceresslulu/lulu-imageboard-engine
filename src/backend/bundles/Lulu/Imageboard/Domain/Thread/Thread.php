<?php
namespace Lulu\Imageboard\Domain\Thread;

use Lulu\Imageboard\Domain\Board\Board;

class Thread
{
    /**
     * Thread Id
     * @var mixed
     */
    private $id;

    /**
     *
     * @var Board
     */
    private $board;

    /**
     * Thread constructor.
     * @param mixed $id
     * @param Board $board
     */
    public function __construct($id, Board $board) {
        $this->id = $id;
        $this->board = $board;
    }

    /**
     * Returns thread Id
     * @return mixed
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
}