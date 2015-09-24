<?php
namespace Lulu\Imageboard\Application\AbstractApplication;

use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

interface ApplicationInterface
{
    /**
     * Returns configuration
     * @return array
     */
    public function getConfiguration();

    /**
     * Returns service manager
     * @return ServiceManagerInterface
     */
    public function getServiceManager();

    /**
     * Bootstrap application
     */
    public function bootstrap();

    /**
     * Run application
     */
    public function run();
}