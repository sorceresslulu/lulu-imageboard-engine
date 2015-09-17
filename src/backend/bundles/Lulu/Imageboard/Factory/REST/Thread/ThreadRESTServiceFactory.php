<?php
namespace Lulu\Imageboard\Factory\REST\Thread;

use Lulu\Imageboard\Domain\Board\Board;
use Lulu\Imageboard\Domain\Thread\ThreadRepositoryInterface;
use Lulu\Imageboard\Repository\Mongo\BoardRepository\Factory\BoardPrototypeFactory;
use Lulu\Imageboard\REST\Thread\ThreadRESTService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ThreadRESTServiceFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        /** @var ThreadRepositoryInterface $threadRepository */
        $threadRepository = $serviceLocator->get('Lulu\Imageboard\Domain\Thread\ThreadRepository');

        /** @var BoardPrototypeFactory $boardPrototypeFactory */
        $boardPrototypeFactory = $serviceLocator->get('Lulu\Imageboard\Domain\Board\BoardRepository\BoardPrototypeFactory');

        return new ThreadRESTService($threadRepository, $boardPrototypeFactory);
    }
}
