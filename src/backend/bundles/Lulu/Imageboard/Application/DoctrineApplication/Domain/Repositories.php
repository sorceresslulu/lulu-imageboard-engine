<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Domain;

use Doctrine\ORM\EntityManager;
use Lulu\Imageboard\Domain\Entity\Board;
use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\Domain\Entity\Thread;

class Repositories
{
    /**
     * Entity Manager
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Repositories constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * Returns entity manager
     * @return EntityManager
     */
    public function getEntityManager() {
        return $this->entityManager;
    }

    /**
     * Returns boards entity repository
     * @return \Doctrine\ORM\EntityRepository
     */
    public function boards() {
        return $this->entityManager->getRepository(Board::class);
    }

    /**
     * Returns threads entity repository
     * @return \Doctrine\ORM\EntityRepository
     */
    public function threads() {
        return $this->entityManager->getRepository(Thread::class);
    }

    /**
     * Returns posts erntity repository
     * @return \Doctrine\ORM\EntityRepository
     */
    public function posts() {
        return $this->entityManager->getRepository(Post::class);
    }
}