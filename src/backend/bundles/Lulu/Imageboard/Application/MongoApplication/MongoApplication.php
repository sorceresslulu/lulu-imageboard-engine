<?php
namespace Lulu\Imageboard\Application\MongoApplication;

use League\Route\RouteCollection;
use Lulu\Imageboard\Application\AbstractApplication\ApplicationInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

define('LI_MONGO_APPLICATION_PATH', __DIR__);
define('LI_MONGO_APPLICATION_CONFIG_PATH', __DIR__.'/Config');

class MongoApplication implements ApplicationInterface
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
     * MongoApplication constructor.
     * @param ServiceManagerInterface $serviceManager
     * @param array $configuration
     */
    public function __construct(ServiceManagerInterface $serviceManager, array $configuration) {
        $this->serviceManager = $serviceManager;
        $this->configuration = array_merge_recursive($configuration, [
            'factories' => require LI_MONGO_APPLICATION_CONFIG_PATH.'/factories.php'
        ]);
    }

    /**
     * @return array
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