<?php
namespace Lulu\Imageboard\Factory\Repository\Mongo;

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

        /** @var BoardPrototypeFactory $boardPrototypeFactory */
        $boardPrototypeFactory = $serviceLocator->get('Lulu\Imageboard\Domain\Board\BoardRepository\BoardPrototypeFactory');

        return new ThreadRepository($mongoThreadCollection, $boardPrototypeFactory);
    }
}
