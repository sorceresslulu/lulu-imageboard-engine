<?php
namespace Lulu\Imageboard\Controller;

use League\Route\Http\Exception\NotFoundException;
use League\Route\Strategy\AbstractStrategy;
use League\Route\Strategy\StrategyInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class LeagueControllerStrategy extends AbstractStrategy implements StrategyInterface
{
    const CONTROLLER_PREFIX = 'Controller';

    /**
     * Service Manager
     * @var ServiceManagerInterface
     */
    private $serviceManager;

    /**
     * Luluboard Controller Strategy
     * @param ServiceManagerInterface $serviceManager
     */
    public function __construct(ServiceManagerInterface $serviceManager) {
        $this->serviceManager = $serviceManager;
    }

    /**
     * @inheritDoc
     */
    public function dispatch($controller, array $vars) {
        $action = 'action'.ucfirst($controller[1]);
        $controller = self::CONTROLLER_PREFIX.'\\'.$controller[0];

        /** @var AbstractController $controllerInstance */
        $controllerInstance = $this->serviceManager->get($controller);

        if(!($controllerInstance instanceof AbstractController)) {
            throw new \Exception(sprintf('Invalid controller `%s`', get_class($controllerInstance)));
        }

        $controllerInstance->setup($this->getRequest(), $vars);

        if(!(method_exists($controllerInstance, $action))) {
            throw new NotFoundException(sprintf('Action `%s` not found', $action));
        }

        return $controllerInstance->$action();
    }
}