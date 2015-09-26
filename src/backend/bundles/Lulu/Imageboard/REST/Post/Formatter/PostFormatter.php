<?php
namespace Lulu\Imageboard\REST\Post\Formatter;

use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\REST\Post\Formatter\PostFormatterInterface;

class PostFormatter implements PostFormatterInterface
{
    /**
     * @inheritDoc
     */
    public function format(Post $post) {
        return [
            'id' => $post->getId(),
            'thread_id' => $post->getThreadId(),
            'author' => $post->getAuthor(),
            'email' => $post->getEmail(),
            'content' => $post->getContent()
        ];
    }
}