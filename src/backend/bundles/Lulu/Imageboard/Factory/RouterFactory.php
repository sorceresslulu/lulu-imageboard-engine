<?php
namespace Lulu\Imageboard\Factory;

use Lulu\Imageboard\REST\RESTServiceInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use League\Route\RouteCollection;

class RouterFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $router = new RouteCollection();

        $this->setupBoardRestService($serviceLocator, $router);

        return $router;
    }

    /**
     * Setup Board REST Service
     * @param ServiceLocatorInterface $serviceLocator
     * @param RouteCollection $router
     */
    private function setupBoardRestService(ServiceLocatorInterface $serviceLocator, RouteCollection $router) {
        $restServices = [
            'Board\BoardRESTService',
            'Thread\ThreadRESTService',
            'Thread\ThreadFeedRESTService',
            'Post\PostRESTService',
        ];

        foreach($restServices as $restServiceName) {
            /** @var RESTServiceInterface $restService */
            $restService = $serviceLocator->get('Lulu\Imageboard\REST\\'.$restServiceName);
            $restService->initRoutes($router);
        }
    }
}