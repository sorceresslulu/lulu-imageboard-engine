<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Doctrine\Converter;

use Lulu\Imageboard\Application\DoctrineApplication\Doctrine\Entity\Post as PostEntity;
use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\Domain\Entity\Thread;
use Lulu\Imageboard\Util\Id;

class PostConverter
{
    public function extract(PostEntity $postEntity, Thread $thread = null) {
        if($postEntity->getId()) {
            $id = new Id($postEntity->getId());
        }else{
            $id = new Id();
        }

        if($thread === null) {
            $threadConverter = new ThreadConverter();
            $thread = $threadConverter->extract($postEntity->getThread());
        }

        $post = new Post($id);
        $post->setEmail($postEntity->getEmail());
        $post->setAuthor($postEntity->getAuthor());
        $post->setContent($postEntity->getContent());
        $post->setThread($thread);

        return $post;
    }

    public function hydrate(Post $post, PostEntity $postEntity)  {
        $postEntity->setEmail($post->getEmail());
        $postEntity->setAuthor($post->getAuthor());
        $postEntity->setContent($post->getContent());
    }
}