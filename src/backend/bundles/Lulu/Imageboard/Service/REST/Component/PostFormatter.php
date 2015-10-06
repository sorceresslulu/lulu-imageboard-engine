<?php
namespace Lulu\Imageboard\Service\REST\Component;

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
            'content' => $post->getContent(),
            'created_on' => $post->getDateCreatedOn()->format(\DateTime::ISO8601),
            'updated_on' => $post->getDateUpdatedOn()->format(\DateTime::ISO8601)
        ];
    }
}