<?php
namespace Lulu\Imageboard\Application\MongoApplication\Factory\Mongo;

use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class MongoDBFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var \MongoClient $mongoClient */
        $mongoClient = $serviceManager->get('MongoClient');
        $mongoConfig = $serviceManager->get('MongoConfiguration');

        if (!(isset($mongoConfig['db']))) {
            throw new \Exception('Key `db` is required');
        }

        return $mongoClient->selectDB($mongoConfig['db']);
    }
}