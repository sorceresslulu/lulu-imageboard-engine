<?php
namespace Lulu\Imageboard\Domain\Thread\Factory;

use Lulu\Imageboard\Domain\Board\Board;

interface BoardPrototypeFactoryInterface
{
    /**
     * @param $id
     * @return Board
     */
    public function getBoardById($id);
}