<?php
namespace Lulu\Imageboard\Factory\Repository\Mongo;

use Lulu\Imageboard\Repository\Mongo\PostRepository;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PostRepositoryFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        /** @var \MongoCollection $mongoBoardCollection */
        $mongoBoardCollection = $serviceLocator->get('Lulu\Imageboard\Adapter\Mongo\Collection\PostCollection');

        return new PostRepository($mongoBoardCollection);
    }
}