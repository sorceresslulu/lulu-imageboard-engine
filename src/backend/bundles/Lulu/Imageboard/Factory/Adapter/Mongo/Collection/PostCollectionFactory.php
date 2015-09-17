<?php
namespace Lulu\Imageboard\Factory\Adapter\Mongo\Collection;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PostCollectionFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        /** @var \MongoDB $mongoDB */
        $mongoDB = $serviceLocator->get('Lulu\Imageboard\Adapter\Mongo\MongoDB');

        return $mongoDB->selectCollection('posts');
    }
}