<?php
namespace Lulu\Imageboard\Util\RequestHelpers;

use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\Service\Thread\Reply\ThreadReplyQuery;
use Lulu\Imageboard\Util\RequestFile;
use Symfony\Component\HttpFoundation\Request;

class CreateReplyQueryBuilder
{
    /**
     * Request
     * @var Request
     */
    private $request;

    /**
     * Thread Id
     * @var int
     */
    private $threadId;

    /**
     * CreateReplyQueryBuilder constructor.
     * @param Request $request
     * @param int $threadId
     */
    public function __construct(Request $request, $threadId) {
        $this->request = $request;
        $this->threadId = $threadId;
    }

    /**
     * Returns request
     * @return Request
     */
    public function getRequest() {
        return $this->request;
    }

    /**
     * Returns thread Id
     * @return int
     */
    public function getThreadId() {
        return $this->threadId;
    }

    /**
     * Build Thread Reply Query
     * @return ThreadReplyQuery
     */
    public function build() {
        $post = $this->buildPost();
        $attachments = $this->buildAttachment();

        return new ThreadReplyQuery($this->threadId, $post, $attachments);
    }

    /**
     * Build Post
     * @return Post
     */
    protected function buildPost() {
        $request = $this->request;

        $post = new Post();
        $post->setContent($request->get('content'));
        $post->setAuthor($request->get('author'));
        $post->setEmail($request->get('email'));

        return $post;
    }

    /**
     * Build attachments
     * @return array
     */
    protected function buildAttachment() {
        $attachments = [];
        $request = $this->request;

        foreach ($request->get('attachments') as $attachment) {
            $attachments[] = RequestFile::createFromRequest($attachment);
        }

        return $attachments;
    }
}