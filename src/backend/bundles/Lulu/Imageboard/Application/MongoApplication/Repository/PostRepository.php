<?php
namespace Lulu\Imageboard\Application\MongoApplication\Repository;

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
            'thread_id' => $thread->getId()->getIdValue()
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
     * @inheritDoc
     */
    public function createPost(Post $post) {
        $postBSON = $this->convertPostToBSON($post);
        $postBSON['_id'] = new \MongoId();

        $this->postsMongoCollection->insert($this->convertPostToBSON($post));

        $post->defineId($postBSON['_id']);
    }

    /**
     * @inheritDoc
     */
    public function updatePost(Post $post) {
        throw new \Exception('Not implemented');
    }

    /**
     * Converts BSON to Post
     * @param array $postBSON
     * @return Post
     */
    private function convertBSONToPost(array $postBSON) {
        $post = new Post($postBSON['_id']);
        $post->setThreadId($postBSON['thread_id'])
             ->setAuthor($postBSON['author'])
             ->setEmail($postBSON['email'])
             ->setContent($postBSON['content'])
        ;

        return $post;
    }

    /**
     * Converts Post to BSON
     * @param Post $post
     * @return array
     */
    private function convertPostToBSON(Post $post) {
        return [
            'thread_id' => $post->getThreadId(),
            'author' => $post->getAuthor(),
            'email' => $post->getEmail(),
            'content' => $post->getContent(),
        ];
    }
}