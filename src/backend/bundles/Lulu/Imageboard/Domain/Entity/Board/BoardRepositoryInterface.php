<?php
namespace Lulu\Imageboard\Domain\Entity\Board;

use Lulu\Imageboard\Domain\Entity\Board\BoardList;

interface BoardRepositoryInterface
{
    /**
     * Returns board by Id
     * @param $id
     * @return Board
     */
    public function getBoardById($id);

    /**
     * Returns all boards
     * @return BoardList
     */
    public function getAllBoards();
}