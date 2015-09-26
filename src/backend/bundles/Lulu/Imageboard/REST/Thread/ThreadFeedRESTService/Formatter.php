<?php
namespace Lulu\Imageboard\REST\Thread\ThreadFeedRESTService;

use Lulu\Imageboard\REST\Post\Formatter\PostFormatter;
use Lulu\Imageboard\Domain\Entity\Post\PostList;
use Lulu\Imageboard\Domain\Entity\Thread\Thread;

class Formatter implements FormatterInterface
{
    /**
     * @inheritDoc
     */
    public function format(Thread $thread, PostList $postList) {
        $postFormatter = new PostFormatter();

        $jsonResponse = [
            'thread' => [
                'id' => (string) $thread->getId(),
            ],
            'posts' => []
        ];

        foreach($postList->getPosts() as $post) {
            $jsonResponse['posts'][] = $postFormatter->format($post);
        }

        return $jsonResponse;
    }
}