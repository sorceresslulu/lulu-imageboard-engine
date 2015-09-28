<?php
namespace Lulu\Imageboard\Service\REST\Thread;

use League\Route\Http\JsonResponse\Ok;
use Lulu\Imageboard\Service\REST\Component\PostFormatter;
use Lulu\Imageboard\Service\Thread\Reply\ThreadReplyQuery;
use Lulu\Imageboard\Service\Thread\Reply\ThreadReplyService;

class ThreadReplyRESTService
{
    /**
     * Reply Service
     * @var ThreadReplyService
     */
    private $replyService;

    /**
     * ThreadReplyRESTService constructor.
     * @param ThreadReplyService $replyService
     */
    public function __construct(ThreadReplyService $replyService) {
        $this->replyService = $replyService;
    }

    /**
     * Reply to thread
     * @param ThreadReplyQuery $replyQuery
     * @return array|mixed
     * @throws \Exception
     */
    public function reply(ThreadReplyQuery $replyQuery) {
        $formatter = new PostFormatter();

        $this->replyService->reply($replyQuery);

        return new Ok($formatter->format($replyQuery->getPost()));
    }
}