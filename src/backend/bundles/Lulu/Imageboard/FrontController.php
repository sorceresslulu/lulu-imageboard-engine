<?php
namespace Lulu\Imageboard;

use League\Route\RouteCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Zend\ServiceManager\ServiceManager;

class FrontController
{
    /**
     * Service Manager
     * @var ServiceManager
     */
    private $serviceManager;

    /**
     * Router
     * @var RouteCollection
     */
    private $router;

    /**
     * FrontController constructor.
     * @param ServiceManager $serviceManager
     */
    public function __construct(ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
        $this->router = $serviceManager->get('Lulu\Imageboard\Router');
    }

    /**
     * Returns service manager
     * @return ServiceManager
     */
    public function getServiceManager() {
        return $this->serviceManager;
    }

    /**
     * Returns router
     * @return RouteCollection
     */
    public function getRouter() {
        return $this->router;
    }

    /**
     * Dispatch
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dispatch(Request $request) {
        try {
            $dispatcher = $this->router->getDispatcher();
            $response = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());
        }catch(\Exception $e){
            $response = new JsonResponse([
                'status_code' => 500,
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ]);
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }
}
