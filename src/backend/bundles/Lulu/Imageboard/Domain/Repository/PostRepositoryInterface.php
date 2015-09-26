<?php
namespace Lulu\Imageboard\Domain\Repository;

use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\Domain\Repository\Post\PostList;
use Lulu\Imageboard\Domain\Entity\Thread;
use Lulu\Imageboard\Util\Seek\SeekableInterface;

interface PostRepositoryInterface
{
    /**
     * Returns all posts
     * @return Post[]
     */
    public function getAllPosts();

    /**
     * Returns all posts
     * Query is limited by seek
     * @param SeekableInterface $seek
     * @return Post[]
     */
    public function getAllPostsWithSeek(SeekableInterface $seek);

    /**
     * Returns all posts of thread
     * @param Thread $thread
     * @return Post[]
     */
    public function getPostsOfThread(Thread $thread);

    /**
     * Returns all posts by thread Id
     * @param $threadId
     * @return Post[]
     */
    public function getPostsByThreadId($threadId);

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
     * Save new post
     * @param int $threadId
     * @param array $params
     * @return
     */
    public function createPost($threadId, array $params);

    /**
     * Update post
     * @param Post $post
     */
    public function updatePost(Post $post);
}