<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Factory\Domain\Repository;

use Lulu\Imageboard\Application\DoctrineApplication\Domain\Repositories;
use Lulu\Imageboard\Application\DoctrineApplication\Domain\Repository\ThreadRepository;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class ThreadRepositoryFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var Repositories $repositories */
        $repositories = $serviceManager->get('Repositories');

        return new ThreadRepository($repositories);
    }
}