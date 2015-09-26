<?php
namespace Lulu\Imageboard\Factory\Controller\Thread;

use Lulu\Imageboard\Controller\Thread\IndexController;
use Lulu\Imageboard\Service\REST\ThreadRESTService;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class IndexControllerFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var ThreadRESTService $threadRESTService */
        $threadRESTService = $serviceManager->get('ThreadRESTService');

        return new IndexController($threadRESTService);
    }
}