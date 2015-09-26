<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Domain\Repository;

use Lulu\Imageboard\Application\DoctrineApplication\Doctrine\Converter\BoardConverter;
use Lulu\Imageboard\Application\DoctrineApplication\Doctrine\Entity\Board as BoardEntity;
use Lulu\Imageboard\Application\DoctrineApplication\Doctrine\Repositories;
use Lulu\Imageboard\Domain\Repository\Board\BoardList;
use Lulu\Imageboard\Domain\Repository\Board\BoardRepositoryInterface;

class BoardRepository implements BoardRepositoryInterface
{
    /**
     * Repositories
     * @var Repositories
     */
    private $repositories;

    /**
     * BoardRepository constructor.
     * @param Repositories $repositories
     */
    public function __construct(Repositories $repositories) {
        $this->repositories = $repositories;
    }

    /**
     * @inheritDoc
     */
    public function getBoardById($id) {
        $result = $this->repositories->boards()->find($id);

        if(!($result instanceof BoardEntity)) {
            throw new \OutOfBoundsException(sprintf('Board with ID `%s` not found', $id));
        }

        $boardConverter = new BoardConverter();
        return $boardConverter->extract($result);
    }

    /**
     * @inheritDoc
     */
    public function getAllBoards() {
        $boards = [];
        $boardConverter = new BoardConverter();
        $result = $this->repositories->boards()->findAll();

        /** @var BoardEntity $boardEntity */
        foreach($result as $boardEntity) {
            $boards[] = $boardConverter->extract($boardEntity);
        }

        return new BoardList($boards);
    }
}