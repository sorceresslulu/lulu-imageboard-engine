<?php
namespace Lulu\Imageboard\Bootstrap;

use Zend\ServiceManager\ServiceManager;

interface BootstrapInterface
{
    public function bootstrap(array $configuration);

    /**
     * Returns service manager
     * @return ServiceManager
     */
    public function getServiceManager();
}