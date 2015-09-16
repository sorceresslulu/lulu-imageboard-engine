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

        foreach($serviceManagerConfiguration['zend_service_manager']['factories'] as $serviceName => $factory) {
            $serviceManager->setFactory($serviceName, $factory);
        }

        return $serviceManager;
    }

    /**
     * @inheritdoc
     */
    public function getServiceManager() {
        return $this->serviceManager;
    }
}