<?php
namespace Lulu\Imageboard\Bootstrap;

use Zend\ServiceManager\ServiceManager;

class Bootstrap implements BootstrapInterface
{
    /**
     * Service Manager
     * @var ServiceManager
     */
    private $serviceManager;

    /**
     * @inheritdoc
     */
    public function bootstrap(array $configuration) {
        $this->setupErrorHandler();
        $this->serviceManager = $this->createServiceManager($configuration);
    }

    /**
     * Create and returns service manager
     * @param array $serviceManagerConfiguration
     * @return ServiceManager
     */
    private function createServiceManager(array $serviceManagerConfiguration) {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('Configuration', $serviceManagerConfiguration);

        foreach ($serviceManagerConfiguration['zend_service_manager']['factories'] as $serviceName => $factory) {
            $serviceManager->setFactory($serviceName, $factory);
        }

        return $serviceManager;
    }

    /**
     * Setup error handler
     */
    private function setupErrorHandler() {
        set_error_handler(function($errno, $errstr, $errfile, $errline) {
            throw new \Exception(sprintf('PHP Error [%d]: %s in file %s:%d', $errno, $errstr, $errfile, $errline));
        });
    }

    /**
     * @inheritdoc
     */
    public function getServiceManager() {
        return $this->serviceManager;
    }
}