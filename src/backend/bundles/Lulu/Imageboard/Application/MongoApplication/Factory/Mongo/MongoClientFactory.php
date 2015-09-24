<?php
namespace Lulu\Imageboard\Application\MongoApplication\Factory\Mongo;

use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class MongoClientFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        $mongoConfig = $serviceManager->get('MongoConfiguration');

        if (!(isset($mongoConfig['server']))) {
            throw new \Exception('Key `server` is required');
        }

        $mongoClient = new \MongoClient(
            $mongoConfig['server'],
            isset($mongoConfig['options']) ? $mongoConfig['options'] : [],
            isset($mongoConfig['driverOptions']) ? $mongoConfig['driverOptions'] : []
        );

        if ($mongoClient->connect()) {
            return $mongoClient;
        } else {
            throw new \Exception(sprintf('Failed to connect'));
        }
    }
}