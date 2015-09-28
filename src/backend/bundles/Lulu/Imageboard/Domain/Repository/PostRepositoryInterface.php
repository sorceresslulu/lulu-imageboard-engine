<?php
namespace Lulu\Imageboard\Domain\Repository;

use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\Domain\Repository\Post\PostQuery;

interface PostRepositoryInterface
{
    /**
     * Create post
     * @param Post $post
     */
    public function createPost(Post $post);

    /**
     * Returns post by Id
     * @param $id
     * @return Post
     */
    public function getPostById($id);

    /**
     * Returns posts by Ids
     * @param array $ids
     * @return Post[]
     */
    public function getPostsByIds(array $ids);

    /**
     * Returns posts by query
     * @param PostQuery $postQuery
     * @return Post[]
     */
    public function getPosts(PostQuery $postQuery);
}