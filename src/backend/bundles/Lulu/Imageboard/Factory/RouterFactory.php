<?php
namespace Lulu\Imageboard\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use League\Route\RouteCollection;
use Lulu\Imageboard\REST\Board\BoardRESTService;

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
        /** @var BoardRESTService $boardRESTService */
        $boardRESTService = $serviceLocator->get('Lulu\Imageboard\REST\Board\BoardRESTService');
        $boardRESTService->initRoutes($router);
    }
}