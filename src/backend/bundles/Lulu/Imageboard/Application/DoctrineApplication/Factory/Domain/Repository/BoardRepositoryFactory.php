<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Factory\Domain\Repository;

use Lulu\Imageboard\Application\DoctrineApplication\Doctrine\Repositories;
use Lulu\Imageboard\Application\DoctrineApplication\Domain\Repository\BoardRepository;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class BoardRepositoryFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var Repositories $repositories */
        $repositories = $serviceManager->get('Repositories');

        return new BoardRepository($repositories);
    }
}