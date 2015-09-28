<?php
namespace Lulu\Imageboard\Controller\Post;

use Lulu\Imageboard\Controller\AbstractController;
use Lulu\Imageboard\Service\REST\PostRESTService;
use Lulu\Imageboard\Util\RequestHelpers\CreatePostQueryBuilder;

class IndexController extends AbstractController
{
    /**
     * Post REST Service
     * @var PostRESTService
     */
    private $postRESTService;

    /**
     * IndexController constructor.
     * @param PostRESTService $postRESTService
     */
    public function __construct(PostRESTService $postRESTService) {
        $this->postRESTService = $postRESTService;
    }

    /**
     * Returns post by id
     * @return \League\Route\Http\JsonResponse\Ok
     * @throws \League\Route\Http\Exception\NotFoundException
     */
    public function actionGetById() {
        $id = $this->getArgs()['id'];

        return $this->postRESTService->getById($id);
    }

    /**
     * Returns posts by ids
     * @return \League\Route\Http\JsonResponse\Ok
     * @throws \Exception
     */
    public function actionGetByIds() {
        $ids = explode(',', $this->getArgs()['ids']);

        return $this->postRESTService->getByIds($ids);
    }

    /**
     * Returns posts by query
     * @return array
     */
    public function actionGetByQuery() {
        $postQueryBuilder = new CreatePostQueryBuilder($this->getRequest());
        $postQueryBuilder->setMaxLimit(false);

        return $this->postRESTService->getPostsByQuery($postQueryBuilder->build());
    }
}