<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Domain\Repository;

use Lulu\Imageboard\Application\DoctrineApplication\Domain\Repositories;
use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\Domain\Entity\Thread;
use Lulu\Imageboard\Domain\Repository\Post\PostQuery;
use Lulu\Imageboard\Domain\Repository\PostRepositoryInterface;
use Lulu\Imageboard\Util\Seek\SeekableInterface;

class PostRepository implements PostRepositoryInterface
{
    /**
     * Repositories
     * @var Repositories
     */
    private $repositories;

    /**
     * PostRepository constructor.
     * @param Repositories $repositories
     */
    public function __construct(Repositories $repositories) {
        $this->repositories = $repositories;
    }

    /**
     * @inheritDoc
     */
    public function createPost(Post $post) {
        $em = $this->repositories->getEntityManager();
        $em->persist($post);
        $em->flush();
    }

    /**
     * @inheritDoc
     */
    public function getPostById($id) {
        $post = $this->repositories->posts()->find($id);

        if(!($post instanceof Post)) {
            throw new \Exception(sprintf('Post with ID `%s` not found', $id));
        }

        return $post;
    }

    /**
     * @inheritDoc
     */
    public function getPostsByIds(array $ids) {
        $repo = $this->repositories->posts();
        $order = ['id' => 'desc'];
        $criteria = [
            'id' => $ids
        ];

        return $this->repositories->posts()->findBy($criteria, $order);
    }

    /**
     * @inheritDoc
     */
    public function getPosts(PostQuery $postQuery) {
        $repo = $this->repositories->posts();

        $limit = $postQuery->getSeek()->getLimit();
        $offset = $postQuery->getSeek()->getOffset();
        $order = ['id' => 'desc'];
        $criteria = [
            'thread' => $postQuery->getThreadId()
        ];

        return $repo->findBy($criteria, $order, $limit, $offset);
    }
}