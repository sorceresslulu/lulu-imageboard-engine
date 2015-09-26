<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Factory\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class EntityManagerFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        $entityDirectory = $serviceManager->get('DoctrineApplicationPath').'/Doctrine/Entity';

        $configuration = Setup::createAnnotationMetadataConfiguration([$entityDirectory], true);
        $connectConfiguration = $serviceManager->get('DoctrineConfiguration');

        return EntityManager::create($connectConfiguration['connection'], $configuration);
    }
}