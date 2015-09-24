<?php
namespace Lulu\Imageboard\Application\MongoApplication\Factory\Repository;

use Lulu\Imageboard\Application\MongoApplication\Repository\BoardRepository;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class BoardRepositoryFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var \MongoDB $mongoDB */
        $mongoDB = $serviceManager->get('MongoDB');

        return new BoardRepository($mongoDB->selectCollection('boards'));
    }
}