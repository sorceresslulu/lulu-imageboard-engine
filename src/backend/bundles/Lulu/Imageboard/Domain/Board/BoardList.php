<?php
namespace Lulu\Imageboard\Domain\Board;

class BoardList
{
    /**
     * Boards
     * @var Board[]
     */
    private $boards;

    /**
     * BoardList constructor.
     * @param Board[] $boards
     */
    public function __construct(array $boards)
    {
        foreach($boards as $board) {
            if(!($board instanceof Board)) {
                throw new \InvalidArgumentException(sprintf('Invalid item for BoardsList, expected Board, got `%s`', var_export($board, true)));
            }
        }

        $this->boards = $boards;
    }

    /**
     * Returns boards
     * @return Board[]
     */
    public function getBoards()
    {
        return $this->boards;
    }
}