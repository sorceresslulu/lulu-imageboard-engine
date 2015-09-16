<?php
namespace Lulu\Imageboard\Domain\Board;

interface RepositoryInterface
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