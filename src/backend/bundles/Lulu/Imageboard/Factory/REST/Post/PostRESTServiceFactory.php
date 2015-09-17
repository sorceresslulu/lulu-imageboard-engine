<?php
namespace Lulu\Imageboard\Factory\REST\Post;

use Lulu\Imageboard\Domain\Post\PostRepositoryInterface;
use Lulu\Imageboard\REST\Post\PostRESTService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PostRESTServiceFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        /** @var PostRepositoryInterface $boardRepository */
        $postRepository = $serviceLocator->get('Lulu\Imageboard\Domain\Post\PostRepository');

        return new PostRESTService($postRepository);
    }
}