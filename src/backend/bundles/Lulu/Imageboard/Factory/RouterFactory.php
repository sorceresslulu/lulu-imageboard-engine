<?php
namespace Lulu\Imageboard\Factory;

use League\Route\RouteCollection;
use Lulu\Imageboard\REST\RESTServiceInterface;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class RouterFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        $router = new RouteCollection();

        $this->setupRESTRoutes($router, $serviceManager);

        return $router;
    }

    /**
     * Setup REST routes
     * @param $router
     * @param ServiceManagerInterface $serviceManager
     */
    private function setupRESTRoutes($router, ServiceManagerInterface $serviceManager) {
        $restServices = [
            'BoardRESTService',
            'ThreadRESTService',
            'ThreadFeedRESTService',
            'PostRESTService'
        ];

        foreach($restServices as $restServiceName) {
            /** @var RESTServiceInterface $restService */
            $restService = $serviceManager->get($restServiceName);
            $restService->initRoutes($router);
        }
    }
}