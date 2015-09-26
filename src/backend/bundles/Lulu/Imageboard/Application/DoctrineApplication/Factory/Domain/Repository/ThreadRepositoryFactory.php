<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Factory\Domain\Repository;

use Doctrine\ORM\EntityManager;
use Lulu\Imageboard\Application\DoctrineApplication\Domain\Repository\ThreadRepository;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class ThreadRepositoryFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var EntityManager $entityManager */
        $entityManager = $serviceManager->get('EntityManager');

        return new ThreadRepository($entityManager);
    }
}