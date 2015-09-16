<?php
namespace Lulu\Imageboard\Factory\Repository\Mongo;

use Lulu\Imageboard\Repository\Mongo\BoardRepository;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BoardRepositoryFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        /** @var \MongoCollection $mongoBoardCollection */
        $mongoBoardCollection = $serviceLocator->get('Lulu\Imageboard\Adapter\Mongo\Collection\BoardCollection');

        return new BoardRepository($mongoBoardCollection);
    }
}