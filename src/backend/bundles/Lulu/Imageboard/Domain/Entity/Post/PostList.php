<?php
namespace Lulu\Imageboard\Domain\Entity\Post;

use Lulu\Imageboard\Domain\Entity\Post\Post;

class PostList
{
    /**
     * Posts
     * @var Post[]
     */
    private $posts;

    /**
     * PostList constructor.
     * @param Post[] $posts
     */
    public function __construct(array $posts) {
        $this->posts = $posts;
    }

    /**
     * Returns posts
     * @return Post[]
     */
    public function getPosts() {
        return $this->posts;
    }
}