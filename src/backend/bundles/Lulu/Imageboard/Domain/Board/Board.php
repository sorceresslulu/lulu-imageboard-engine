<?php
namespace Lulu\Imageboard\Domain\Board;

class Board
{
    /**
     * Id
     * @var mixed
     */
    private $id;

    /**
     * Title
     * @var string
     */
    private $title;

    /**
     * Board constructor.
     * @param mixed $id
     * @param string $title
     */
    public function __construct($id, $title) {
        $this->id = $id;
        $this->title = $title;
    }

    /**
     * Returns Id
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Returns title
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }
}