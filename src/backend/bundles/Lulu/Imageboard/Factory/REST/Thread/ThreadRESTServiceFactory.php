<?php
namespace Lulu\Imageboard\Factory\REST\Thread;

use Lulu\Imageboard\Domain\Thread\ThreadRepositoryInterface;
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

        return new ThreadRESTService($threadRepository);
    }
}
