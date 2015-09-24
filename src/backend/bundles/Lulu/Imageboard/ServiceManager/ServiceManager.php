<?php
namespace Lulu\Imageboard\ServiceManager;

use Lulu\Imageboard\ServiceManager\Component\Definitions;
use Lulu\Imageboard\ServiceManager\Component\Services;

class ServiceManager implements ServiceManagerInterface
{
    /**
     * Service Factories definitions
     * @var Definitions
     */
    protected $definitions;

    /**
     * Service instances
     * @var Services
     */
    protected $instances;

    /**
     * Service Manager
     */
    public function __construct() {
        $this->definitions = new Definitions();
        $this->instances = new Services();
    }

    /**
     * @inheritdoc
     */
    public function get($serviceName) {
        if(!($this->instances->hasServiceWithName($serviceName))) {
            $this->instances->addService($serviceName, $this->create($serviceName));
        }

        return $this->instances->getService($serviceName);
    }

    /**
     * @inheritdoc
     */
    public function create($serviceName) {
        $serviceFactory = $this->definitions->createServiceFactory($serviceName);

        return $serviceFactory->createServiceInstance($this);
    }

    /**
     * @inheritdoc
     */
    public function getDefinitions() {
        return $this->definitions;
    }

    /**
     * @inheritdoc
     */
    public function getInstances() {
        return $this->instances;
    }
}