<?php
namespace Lulu\Imageboard\Controller\Thread;

use Lulu\Imageboard\Controller\AbstractController;
use Lulu\Imageboard\Service\REST\Thread\ThreadReplyRESTService;
use Lulu\Imageboard\Util\RequestHelpers\CreateReplyQueryBuilder;

class ReplyController extends AbstractController
{
    /**
     * Thread Reply REST Service
     * @var ThreadReplyRESTService
     */
    private $threadReplyRESTService;

    /**
     * ReplyController constructor.
     * @param ThreadReplyRESTService $threadReplyRESTService
     */
    public function __construct(ThreadReplyRESTService $threadReplyRESTService) {
        $this->threadReplyRESTService = $threadReplyRESTService;
    }

    /**
     * Reply
     */
    public function actionReply() {
        $replyQueryBuilder = new CreateReplyQueryBuilder($this->getRequest(), $this->getArgs()['threadId']);
        $replyQuery = $replyQueryBuilder->build();

        return $this->threadReplyRESTService->reply($replyQuery);
    }
}