<?php
namespace Lulu\Imageboard\ServiceManager;

use Lulu\Imageboard\ServiceManager\Component\Definitions;
use Lulu\Imageboard\ServiceManager\Component\Services;

interface ServiceManagerInterface
{
    /**
     * Returns service by name
     * @param $serviceName
     * @return object
     */
    public function get($serviceName);

    /**
     * Create and returns new service instance
     * @param $serviceName
     * @return mixed
     */
    public function create($serviceName);

    /**
     * Returns definitions
     * @return Definitions
     */
    public function getDefinitions();

    /**
     * Returns instances
     * @return Services
     */
    public function getInstances();
}