<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Domain\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Lulu\Imageboard\Application\DoctrineApplication\Doctrine\Converter\PostConverter;
use Lulu\Imageboard\Application\DoctrineApplication\Doctrine\Converter\ThreadConverter;
use Lulu\Imageboard\Application\DoctrineApplication\Doctrine\Entity\Thread as ThreadEntity;
use Lulu\Imageboard\Application\DoctrineApplication\Doctrine\Repositories;
use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\Domain\Entity\Thread;
use Lulu\Imageboard\Domain\Repository\Thread\Component\ThreadListQuery;
use Lulu\Imageboard\Domain\Repository\Thread\ThreadList;
use Lulu\Imageboard\Domain\Repository\Thread\ThreadRepositoryInterface;
use Lulu\Imageboard\Application\DoctrineApplication\Doctrine\Entity\Post as PostEntity;
use Lulu\Imageboard\Application\DoctrineApplication\Doctrine\Entity\Board as BoardEntity;
use Lulu\Imageboard\Util\QueryList;

class ThreadRepository implements ThreadRepositoryInterface
{
    /**
     * Repositories
     * @var Repositories
     */
    private $repositories;

    /**
     * ThreadRepository constructor.
     * @param Repositories $repositories
     */
    public function __construct(Repositories $repositories) {
        $this->repositories = $repositories;
    }


    /**
     * @inheritDoc
     */
    public function getThreads(ThreadListQuery $threadListQuery) {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function getThreadById($threadId) {
        $threadEntity = $this->repositories->threads()->find($threadId);

        if(!($threadEntity instanceof ThreadEntity)) {
            throw new \OutOfBoundsException(sprintf('Thread with ID `%s` not found', $threadId));
        }

        $threadConverter = new ThreadConverter();

        return $threadConverter->extract($threadEntity);
    }

    /**
     * @inheritDoc
     */
    public function getThreadsByIds(array $threadIds) {
        $threads = [];
        $threadConverter = new ThreadConverter();
        $threadEntities = $this->repositories->threads()->findBy([
            'id' => $threadIds
        ]);

        foreach($threadEntities as $threadEntity) {
            $threads[] = $threadConverter->extract($threadEntity);
        }

        return new ThreadList($threads);
    }

    /**
     * @inheritDoc
     */
    public function createNewThread($boardId, Post $post) {
        $board = $this->repositories->boards()->find($boardId);

        if(!($board instanceof BoardEntity)) {
            throw new \OutOfBoundsException(sprintf('Board with ID `%s` not found', $boardId));
        }

        $threadEntity = new ThreadEntity();

        $postEntity = new PostEntity();
        $postEntity->setThread($threadEntity);

        $postConverter = new PostConverter();
        $postConverter->hydrate($post, $postEntity);

        $threadEntity->setBoard($board);
        $threadEntity->setPosts(new ArrayCollection([
            $postEntity
        ]));

        $em = $this->repositories->getEntityManager();
        $em->persist($threadEntity);
        $em->flush();
            }
}