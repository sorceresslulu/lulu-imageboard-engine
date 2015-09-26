<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Factory\Domain;

use Doctrine\ORM\EntityManager;
use Lulu\Imageboard\Application\DoctrineApplication\Domain\Repositories;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class RepositoriesFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var EntityManager $entityManager */
        $entityManager = $serviceManager->get('EntityManager');

        return new Repositories($entityManager);
    }
}
