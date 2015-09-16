<?php
namespace Lulu\Imageboard\Factory\Adapter\Mongo\Collection;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BoardCollectionFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        /** @var \MongoDB $mongoDB */
        $mongoDB = $serviceLocator->get('Lulu\Imageboard\Factory\Adapter\Mongo\MongoDB');

        return $mongoDB->selectCollection('boards');
    }
}