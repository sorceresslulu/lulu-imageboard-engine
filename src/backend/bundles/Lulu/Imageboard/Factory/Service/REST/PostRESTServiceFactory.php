<?php
namespace Lulu\Imageboard\Factory\Service\REST;

use Lulu\Imageboard\Domain\Repository\PostRepositoryInterface;
use Lulu\Imageboard\Service\REST\PostRESTService;
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