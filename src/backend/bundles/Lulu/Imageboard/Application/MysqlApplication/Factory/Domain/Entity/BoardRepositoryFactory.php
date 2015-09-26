<?php
namespace Lulu\Imageboard\Application\MysqlApplication\Factory\Domain\Entity;

use Lulu\Imageboard\Application\MysqlApplication\Domain\Entity\Board\BoardRepository;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class BoardRepositoryFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var \mysqli $mysqli */
        $mysqli = $serviceManager->get('Mysqli');

        return new BoardRepository($mysqli);
    }
}