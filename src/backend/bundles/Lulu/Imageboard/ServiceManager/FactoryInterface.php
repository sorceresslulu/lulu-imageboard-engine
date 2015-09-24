<?php
namespace Lulu\Imageboard\ServiceManager;

use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

interface FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager);
}