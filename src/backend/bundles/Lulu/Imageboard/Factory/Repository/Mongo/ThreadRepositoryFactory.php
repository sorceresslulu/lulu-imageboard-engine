<?php
namespace Lulu\Imageboard\Factory\Repository\Mongo;

use Lulu\Imageboard\Domain\Post\PostRepositoryInterface;
use Lulu\Imageboard\Repository\Mongo\BoardRepository\Factory\BoardPrototypeFactory;
use Lulu\Imageboard\Repository\Mongo\ThreadRepository;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ThreadRepositoryFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        /** @var \MongoCollection $mongoThreadCollection */
        $mongoThreadCollection = $serviceLocator->get('Lulu\Imageboard\Adapter\Mongo\Collection\ThreadCollection');

        /** @var PostRepositoryInterface $postRepository */
        $postRepository = $serviceLocator->get('Lulu\Imageboard\Domain\Post\PostRepository');

        return new ThreadRepository($mongoThreadCollection, $postRepository);
    }
}
