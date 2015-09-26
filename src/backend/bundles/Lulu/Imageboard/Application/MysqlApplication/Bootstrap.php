<?php
namespace Lulu\Imageboard\Application\MysqlApplication;

use Lulu\Imageboard\Application\AbstractApplication\ApplicationInterface;

class Bootstrap
{
    /**
     * Mongo Application
     * @var ApplicationInterface
     */
    private $application;

    /**
     * Bootstrap constructor.
     * @param ApplicationInterface $application
     */
    public function __construct(ApplicationInterface $application) {
        $this->application = $application;
    }

    /**
     * Bootstrap
     */
    public function bootstrap() {
        $this->setupPHPErrorHandler();
        $this->setupConfiguration();
        $this->setupServiceManager();
    }

    /**
     * Setup handler for PHP errors
     */
    private function setupPHPErrorHandler() {
        set_error_handler(function($errno, $errstr, $errfile, $errline) {
            throw new \Exception(sprintf('PHP Error [%d]: %s in file %s:%d', $errno, $errstr, $errfile, $errline));
        });
    }

    /**
     * Setup configuration
     */
    private function setupConfiguration() {
        $this->application->getServiceManager()->getInstances()->addService('MysqlConfiguration', $this->application->getConfiguration()['mysqli-adapter']);
    }

    /**
     * Setup service manager
     */
    private function setupServiceManager() {
        $serviceManager = $this->application->getServiceManager();
        $factories = $this->application->getConfiguration()['factories'];

        foreach($factories as $serviceName => $serviceFactory) {
            $serviceManager->getDefinitions()->defineServiceFactory($serviceName, $serviceFactory);
        }
    }
}