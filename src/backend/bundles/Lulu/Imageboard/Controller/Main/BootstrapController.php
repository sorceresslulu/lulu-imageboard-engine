<?php
namespace Lulu\Imageboard\Controller\Main;

use League\Route\Http\JsonResponse\Ok;
use Lulu\Imageboard\Controller\AbstractController;
use Lulu\Imageboard\Service\BootstrapService;

class BootstrapController extends AbstractController
{
    /**
     * Bootstrap Service
     * @var BootstrapService
     */
    private $bootstrapService;

    /**
     * BootstrapController constructor.
     * @param BootstrapService $bootstrapService
     */
    public function __construct(BootstrapService $bootstrapService) {
        $this->bootstrapService = $bootstrapService;
    }

    /**
     * Returns bootstrap
     * @return Ok
     */
    public function actionBootstrap() {
        return new Ok($this->bootstrapService->bootstrap());
    }
}