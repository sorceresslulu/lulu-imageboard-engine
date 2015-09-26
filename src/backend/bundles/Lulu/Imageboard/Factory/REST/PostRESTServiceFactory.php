<?php
namespace Lulu\Imageboard\Factory\REST;

use Lulu\Imageboard\Domain\Repository\Post\PostRepositoryInterface;
use Lulu\Imageboard\REST\Post\PostRESTService;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class PostRESTServiceFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var PostRepositoryInterface $postRepository */
        $postRepository = $serviceManager->get('PostRepository');

        return new PostRESTService($postRepository);
    }
}