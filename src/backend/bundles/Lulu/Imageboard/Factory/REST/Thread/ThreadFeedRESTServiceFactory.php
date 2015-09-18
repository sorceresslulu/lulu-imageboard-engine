<?php
namespace Lulu\Imageboard\Factory\REST\Thread;

use Lulu\Imageboard\Domain\Post\PostRepositoryInterface;
use Lulu\Imageboard\Domain\Thread\ThreadRepositoryInterface;
use Lulu\Imageboard\REST\Thread\ThreadFeedRESTService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ThreadFeedRESTServiceFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        /** @var ThreadRepositoryInterface $threadRepository */
        $threadRepository = $serviceLocator->get('Lulu\Imageboard\Domain\Thread\ThreadRepository');

        /** @var PostRepositoryInterface $postRepository */
        $postRepository = $serviceLocator->get('Lulu\Imageboard\Domain\Post\PostRepository');

        return new ThreadFeedRESTService($threadRepository, $postRepository);
    }
}