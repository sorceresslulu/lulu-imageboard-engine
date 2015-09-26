<?php
namespace Lulu\Imageboard\REST\Thread\ThreadFeedRESTService;

use Lulu\Imageboard\REST\Post\Formatter\PostFormatter;
use Lulu\Imageboard\Domain\Repository\Post\PostList;
use Lulu\Imageboard\Domain\Entity\Thread;

class Formatter implements FormatterInterface
{
    /**
     * @inheritDoc
     */
    public function format(Thread $thread) {
        $postFormatter = new PostFormatter();

        $jsonResponse = [
            'thread' => [
                'id' => $thread->getId(),
            ],
            'posts' => []
        ];

        foreach($thread->getPosts() as $post) {
            $jsonResponse['posts'][] = $postFormatter->format($post);
        }

        return $jsonResponse;
    }
}