<?php
namespace Lulu\Imageboard\Factory\Service;

use Lulu\Imageboard\Service\BootstrapService;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class BootstrapServiceFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        return new BootstrapService($serviceManager);
    }
}