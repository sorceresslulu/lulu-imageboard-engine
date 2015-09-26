<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Domain\Repository;

use Doctrine\ORM\EntityManager;
use Lulu\Imageboard\Domain\Entity\Board;
use Lulu\Imageboard\Domain\Repository\Board\BoardList;
use Lulu\Imageboard\Domain\Repository\Board\BoardRepositoryInterface;

class BoardRepository implements BoardRepositoryInterface
{
    /**
     * Entity Manager
     * @var EntityManager
     */
    private $entityManager;

    /**
     * BoardRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritDoc
     */
    public function getBoardById($id) {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function getAllBoards() {
        throw new \Exception('Not implemented');
    }
}