<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Doctrine\Converter;

use Lulu\Imageboard\Application\DoctrineApplication\Doctrine\Entity\Board as BoardEntity;
use Lulu\Imageboard\Domain\Entity\Board;
use Lulu\Imageboard\Util\Id;

class BoardConverter
{
    public function extract(BoardEntity $boardEntity) {
        if($boardEntity->getId()) {
            $id = new Id($boardEntity->getId());
        }else{
            $id = new Id();
        }
        
        $board = new Board($id);
        $board->setUrl($boardEntity->getUrl());
        $board->setTitle($boardEntity->getTitle());
        $board->setDescription($boardEntity->getDescription());

        return $board;
    }
}