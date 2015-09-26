<?php
namespace Lulu\Imageboard\Application\DoctrineApplication;

use League\Route\RouteCollection;
use Lulu\Imageboard\Application\AbstractApplication\ApplicationInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

define('LI_DOCTRINE_APPLICATION_CONFIG_PATH', __DIR__.'/config');

class DoctrineApplication implements ApplicationInterface
{
    /**
     * Configuration
     * @var array
     */
    protected $configuration;

    /**
     * Service Manager
     * @var ServiceManagerInterface
     */
    protected $serviceManager;

    /**
     * DoctrineApplication
     * @param ServiceManagerInterface $serviceManager
     * @param array $configuration
     */
    public function __construct(ServiceManagerInterface $serviceManager, array $configuration) {
        $this->serviceManager = $serviceManager;
        $this->configuration = array_merge_recursive($configuration, [
            'factories' => require LI_DOCTRINE_APPLICATION_CONFIG_PATH.'/factories.php'
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getConfiguration() {
        return $this->configuration;
    }

    /**
     * @inheritDoc
     */
    public function getServiceManager() {
        return $this->serviceManager;
    }

    /**
     * @inheritDoc
     */
    public function bootstrap() {
        $bootstrap = new Bootstrap($this);
        $bootstrap->bootstrap();
    }

    /**
     * @inheritDoc
     */
    public function run() {
        /** @var RouteCollection $router */
        $router = $this->serviceManager->get('Router');
        $request = Request::createFromGlobals();

        try {
            $response = $router->getDispatcher()->dispatch($request->getMethod(), $request->getPathInfo());
        }catch(\Exception $e) {
            $response = new JsonResponse([
                'status_code' => 500,
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ]);
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        $response->send();
    }
}