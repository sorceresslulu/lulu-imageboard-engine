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
        $posts = [];

        $cursor = $this->postsMongoCollection->find([
            'thread_id' => new \MongoId($thread->getId())
        ]);

        foreach($cursor as $postBSON) {
            $posts[] = $this->convertBSONToPost($postBSON);
        }

        return new PostList($posts);
    }

    /**
     * @inheritDoc
     */
    public function getPostById($id) {
        $postBSON = $this->postsMongoCollection->findOne([
            '_id' => new \MongoId($id)
        ]);

        if(!($postBSON)) {
            throw new \OutOfBoundsException(sprintf('Post with Id `%s` not found', (string) $id));
        }

        return $this->convertBSONToPost($postBSON);
    }

    /**
     * @inheritDoc
     */
    public function getPostsByIds(array $ids) {
        $posts = [];

        $cursor = $this->postsMongoCollection->find([
            '_id' => ['$in' => $ids]
        ]);

        foreach($cursor as $postBSON) {
            $posts[] = $this->convertBSONToPost($postBSON);
        }

        return new PostList($posts);
    }

    /**
     * @inheritDoc
     */
    public function getPostsByThreadId($threadId) {
        $posts = [];

        $cursor = $this->postsMongoCollection->find([
            'thread_id' => new \MongoId($threadId)
        ]);

        foreach($cursor as $postBSON) {
            $posts[] = $this->convertBSONToPost($postBSON);
        }

        return new PostList($posts);
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