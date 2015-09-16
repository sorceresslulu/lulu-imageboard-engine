<?php
namespace Lulu\Imageboard\Factory\Adapter\Mongo;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MongoClientFactory implements FactoryInterface
{
    const MONGO_DB_CONFIG_KEY = 'mongo-adapter';

    /**
     * @inheritDoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $configuration = $serviceLocator->get('Configuration');

        if(!(isset($configuration[self::MONGO_DB_CONFIG_KEY]))) {
            throw new \Exception(sprintf('No configuration by key `%s` available', self::MONGO_DB_CONFIG_KEY));
        }

        $mongoConfig = $configuration[self::MONGO_DB_CONFIG_KEY];

        if(!(isset($mongoConfig['server']))) {
            throw new \Exception('Key `server` is required');
        }

        $mongoClient = new \MongoClient(
            $mongoConfig['server'],
            isset($mongoConfig['options']) ? $mongoConfig['options'] : null,
            isset($mongoConfig['driverOptions']) ? $mongoConfig['driverOptions'] : null
        );

        if($mongoClient->connected) {
            return $mongoClient;
        }else{
            throw new \Exception(sprintf('Failed to connect'));
        }
    }
}