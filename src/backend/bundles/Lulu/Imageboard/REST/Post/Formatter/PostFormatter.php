<?php
namespace Lulu\Imageboard\REST\Post\Formatter;

use Lulu\Imageboard\Domain\Entity\Post;

class PostFormatter implements PostFormatterInterface
{
    /**
     * @inheritDoc
     */
    public function format(Post $post) {
        return [
            'id' => $post->getId(),
            'thread_id' => (string) $post->getThread()->getId(),
            'author' => $post->getAuthor(),
            'email' => $post->getEmail(),
            'content' => $post->getContent()
        ];
    }
}