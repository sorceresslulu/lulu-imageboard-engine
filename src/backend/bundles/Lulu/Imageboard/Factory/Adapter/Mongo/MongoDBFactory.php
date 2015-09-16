<?php
namespace Lulu\Imageboard\Factory\Adapter\Mongo;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MongoDBFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        /** @var \MongoClient $mongoClient */
        $mongoClient = $serviceLocator->get('Lulu\Imageboard\Adapter\Mongo\MongoClient');
        $configuration = $serviceLocator->get('Configuration');
        $mongoConfig = $configuration[MongoClientFactory::MONGO_DB_CONFIG_KEY];

        if(!(isset($mongoConfig['db']))) {
            throw new \Exception('Key `db` is required');
        }

        return $mongoClient->selectDB($mongoConfig['db']);
    }
}