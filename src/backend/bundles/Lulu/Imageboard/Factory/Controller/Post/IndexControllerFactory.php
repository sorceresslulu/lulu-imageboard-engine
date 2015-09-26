<?php
namespace Lulu\Imageboard\Factory\Controller\Post;

use Lulu\Imageboard\Controller\Post\IndexController;
use Lulu\Imageboard\Service\REST\PostRESTService;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class IndexControllerFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var PostRESTService $postRESTService */
        $postRESTService = $serviceManager->get('PostRESTService');

        return new IndexController($postRESTService);
    }
}