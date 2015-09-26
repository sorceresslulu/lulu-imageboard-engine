<?php
namespace Lulu\Imageboard\Domain\Repository;

use Lulu\Imageboard\Domain\Entity\Board;
use Lulu\Imageboard\Domain\Repository\Board\BoardList;

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
     * @return Board[]
     */
    public function getAllBoards();
}