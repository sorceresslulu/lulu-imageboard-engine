<?php
namespace Lulu\Imageboard\Controller\Board;

use Lulu\Imageboard\Controller\AbstractController;
use Lulu\Imageboard\Service\REST\BoardRESTService;

class IndexController extends AbstractController
{
    /**
     * Board REST Service
     * @var BoardRESTService
     */
    private $boardRESTService;

    /**
     * IndexController constructor.
     * @param BoardRESTService $boardRESTService
     */
    public function __construct(BoardRESTService $boardRESTService) {
        $this->boardRESTService = $boardRESTService;
    }

    /**
     * Returns list of all boards
     * @return \League\Route\Http\JsonResponse\Ok
     */
    public function actionGetAll() {
        return $this->boardRESTService->getAll();
    }

    /**
     * Returns board by Id
     * @return \League\Route\Http\JsonResponse\Ok
     * @throws \League\Route\Http\Exception\NotFoundException
     */
    public function actionGetById() {
        return $this->boardRESTService->getById($this->getArgs()['id']);
    }
}