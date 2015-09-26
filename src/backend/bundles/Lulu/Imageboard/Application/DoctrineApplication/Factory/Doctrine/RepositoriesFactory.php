<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Factory\Doctrine;

use Doctrine\ORM\EntityManager;
use Lulu\Imageboard\Application\DoctrineApplication\Doctrine\Repositories;
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
