<?php
namespace Lulu\Imageboard\Service\REST\Component;

use Lulu\Imageboard\Service\REST\Component\PostFormatter;
use Lulu\Imageboard\Domain\Entity\Thread;
use Lulu\Imageboard\Service\REST\Component\ThreadFeedFormatterInterface;

class ThreadFeedFormatter implements ThreadFeedFormatterInterface
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