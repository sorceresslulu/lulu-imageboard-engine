<?php
namespace Lulu\Imageboard\REST\Post\Util;

use Lulu\Imageboard\Domain\Post\Post;

class CreatePostFromRequest
{
    public function createPostFromRequest($threadId, array $request) {
        $post = new Post();
        $post->setThreadId(new \MongoId($threadId))
            ->setEmail($request['email'])
            ->setAuthor($request['author'])
            ->setContent($request['content'])
        ;

        return $post;
    }
}