<?php
namespace Lulu\Imageboard\Controller\Thread;

use Lulu\Imageboard\Controller\AbstractController;
use Lulu\Imageboard\Service\REST\ThreadFeedRESTService;

class FeedController extends AbstractController
{
    /**
     * Thread Feed Rest Service
     * @var ThreadFeedRESTService
     */
    private $threadFeedRESTService;

    /**
     * FeedController constructor.
     * @param ThreadFeedRESTService $threadFeedRESTService
     */
    public function __construct(ThreadFeedRESTService $threadFeedRESTService) {
        $this->threadFeedRESTService = $threadFeedRESTService;
    }

    /**
     * Returns thread feed
     * @return \League\Route\Http\JsonResponse\Ok
     * @throws \League\Route\Http\Exception\NotFoundException
     */
    public function actionGetFeed() {
        return $this->threadFeedRESTService->getFeed($this->getArgs()['id']);
    }
}