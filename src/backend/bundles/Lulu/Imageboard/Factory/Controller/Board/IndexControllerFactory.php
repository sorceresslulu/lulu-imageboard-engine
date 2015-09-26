<?php
namespace Lulu\Imageboard\Factory\Controller\Board;

use Lulu\Imageboard\Controller\Board\IndexController;
use Lulu\Imageboard\Service\REST\BoardRESTService;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class IndexControllerFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var BoardRESTService $boardRESTService */
        $boardRESTService = $serviceManager->get('BoardRESTService');

        return new IndexController($boardRESTService);
    }
}