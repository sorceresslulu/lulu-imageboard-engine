<?php
namespace Lulu\Imageboard\Controller\Thread;

use Lulu\Imageboard\Controller\AbstractController;
use Lulu\Imageboard\Service\REST\ThreadRESTService;
use Lulu\Imageboard\Util\Seek\SeekFromRequest;

class IndexController extends AbstractController
{
    const MAX_LIMIT = 1000;
    const DEFAULT_LIMIT = 10;

    /**
     * Thread REST Service
     * @var ThreadRESTService
     */
    private $threadRESTService;

    /**
     * IndexController constructor.
     * @param ThreadRESTService $threadRESTService
     */
    public function __construct(ThreadRESTService $threadRESTService) {
        $this->threadRESTService = $threadRESTService;
    }

    /**
     * Create New Thread
     * @return \League\Route\Http\JsonResponse\Ok
     */
    public function actionCreateNewThread() {
        $request = $this->getRequest();
        $boardId = $this->getArgs()['boardId'];

        return $this->threadRESTService->createNewThread($boardId, $request->request->all());
    }

    /**
     * Returns thread by Id
     * @return \League\Route\Http\JsonResponse\Ok
     * @throws \League\Route\Http\Exception\NotFoundException
     */
    public function actionGetById() {
        return $this->threadRESTService->getById($this->getArgs()['id']);
    }

    /**
     * Returns threads by Ids
     * @return \League\Route\Http\JsonResponse\Ok
     */
    public function actionGetByIds() {
        return $this->threadRESTService->getByIds(explode(',', $this->getArgs()['ids']));
    }

    /**
     * Returns threads by boardId
     * @return \League\Route\Http\JsonResponse\Ok
     */
    public function actionGetByBoardId() {
        $boardId = $this->getArgs()['boardId'];
        $seek = new SeekFromRequest($this->getRequest(), self::MAX_LIMIT, self::DEFAULT_LIMIT);

        return $this->threadRESTService->getByBoardId($boardId, $seek);
    }
}