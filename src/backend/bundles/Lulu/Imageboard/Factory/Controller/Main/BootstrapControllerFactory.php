<?php
namespace Lulu\Imageboard\Factory\Controller\Main;

use Lulu\Imageboard\Controller\Main\BootstrapController;
use Lulu\Imageboard\Service\BootstrapService;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class BootstrapControllerFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var BootstrapService $bootstrapService */
        $bootstrapService = $serviceManager->get('Bootstrap');

        return new BootstrapController($bootstrapService);
    }
}