<?php
namespace Lulu\Imageboard\Service;

use Lulu\Imageboard\Service\REST\BoardRESTService;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class BootstrapService
{
    /**
     * Service Manager
     * @var ServiceManagerInterface
     */
    private $serviceManager;

    /**
     * BootstrapService constructor.
     * @param ServiceManagerInterface $serviceManager
     */
    public function __construct(ServiceManagerInterface $serviceManager) {
        $this->serviceManager = $serviceManager;
    }

    /**
     * Bootstrap for angular
     * @return array
     */
    public function bootstrap() {
        $sm = $this->serviceManager;

        return [
            'configuration' => $sm->get('BootstrapConfiguration'),
            'boards' => $this->getBoards()
        ];
    }

    /**
     * Returns boards list
     * @return array
     */
    private function getBoards() {
        /** @var BoardRESTService $boardsRestService */
        $boardsRestService = $this->serviceManager->get('BoardRESTService');

        return json_decode($boardsRestService->getAll()->getContent(), true);
    }
}