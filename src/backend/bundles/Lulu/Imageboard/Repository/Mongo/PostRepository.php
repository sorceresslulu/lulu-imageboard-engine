<?php
namespace Lulu\Imageboard\Repository\Mongo;

use Lulu\Imageboard\Domain\Post\Post;
use Lulu\Imageboard\Domain\Post\PostList;
use Lulu\Imageboard\Domain\Post\PostRepositoryInterface;
use Lulu\Imageboard\Domain\Thread\Thread;
use Lulu\Imageboard\Util\Seek\SeekableInterface;

class PostRepository implements PostRepositoryInterface
{
    /**
     * Posts mongo collection
     * @var \MongoCollection
     */
    private $postsMongoCollection;

    /**
     * PostRepository constructor.
     * @param \MongoCollection $postsMongoCollection
     */
    public function __construct(\MongoCollection $postsMongoCollection) {
        $this->postsMongoCollection = $postsMongoCollection;
    }


    /**
     * @inheritDoc
     */
    public function getAllPosts() {
        $posts = [];
        $cursor = $this->postsMongoCollection->find([]);

        foreach($cursor as $postBSON) {
            $posts[] = $this->convertBSONToPost($postBSON);
        }

        return new PostList($posts);
    }

    /**
     * @inheritDoc
     */
    public function getAllPostsWithSeek(SeekableInterface $seek) {
        $posts = [];

        $cursor = $this->postsMongoCollection->find([]);
        $cursor->skip($seek->getOffset());
        $cursor->limit($seek->getLimit());

        foreach($cursor as $postBSON) {
            $posts[] = $this->convertBSONToPost($postBSON);
        }

        return new PostList($posts);
    }

    /**
     * @inheritDoc
     */
    public function getPostsOfThread(Thread $thread) {
        // TODO: Implement getPostsOfThread() method.
    }

    /**
     * @inheritDoc
     */
    public function getPostById($id) {
        // TODO: Implement getPostById() method.
    }

    /**
     * It should be somewhere else
     * @param array $postBSON
     * @return Post
     */
    private function convertBSONToPost(array $postBSON) {
        return new Post(
            $postBSON['_id'],
            $postBSON['thread_id'],
            $postBSON['content']
        );
    }
}