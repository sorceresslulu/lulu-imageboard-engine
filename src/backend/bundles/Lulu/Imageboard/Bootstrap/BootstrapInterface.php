<?php
namespace Lulu\Imageboard\Bootstrap;

use Zend\ServiceManager\ServiceManager;

interface BootstrapInterface
{
    /**
     * Bootstrap
     * @param array $configuration
     * @return mixed
     */
    public function bootstrap(array $configuration);

    /**
     * Returns service manager
     * @return ServiceManager
     */
    public function getServiceManager();
}