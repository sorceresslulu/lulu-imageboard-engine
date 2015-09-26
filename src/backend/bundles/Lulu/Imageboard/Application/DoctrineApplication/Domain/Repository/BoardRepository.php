<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Domain\Repository;

use Lulu\Imageboard\Application\DoctrineApplication\Domain\Repositories;
use Lulu\Imageboard\Domain\Entity\Board;
use Lulu\Imageboard\Domain\Repository\BoardRepositoryInterface;

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

        if(!($result instanceof Board)) {
            throw new \OutOfBoundsException(sprintf('Board with ID `%s` not found', $id));
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getAllBoards() {
        return $this->repositories->boards()->findAll();
    }
}