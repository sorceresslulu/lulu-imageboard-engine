<?php
namespace Lulu\Imageboard\Application\MysqlApplication\Factory\Domain\Entity;

use Lulu\Imageboard\Application\MysqlApplication\Domain\Entity\Thread\ThreadRepository;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class ThreadRepositoryFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var \mysqli $mysqli */
        $mysqli = $serviceManager->get('Mysqli');

        return new ThreadRepository($mysqli);
    }
}