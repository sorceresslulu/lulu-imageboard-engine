<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Domain\Repository;

use Lulu\Imageboard\Application\DoctrineApplication\Domain\Repositories;
use Lulu\Imageboard\Domain\Entity\Board;
use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\Domain\Entity\Thread;
use Lulu\Imageboard\Domain\Repository\Thread\Component\ThreadListQuery;
use Lulu\Imageboard\Domain\Repository\ThreadRepositoryInterface;
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
        $repository = $this->repositories->threads();

        $criteria = [
            'board' => $threadListQuery->getBoard()
        ];
        $limit = $threadListQuery->getSeek()->getLimit();
        $offset = $threadListQuery->getSeek()->getOffset();

        $threads = $repository->findBy($criteria, null, $limit, $offset);

        $countQuery = $repository->createQueryBuilder('t');
        $countQuery
            ->select('count(t.id)')
            ->where('t.board = :board')
            ->setParameter('board', $threadListQuery->getBoard())
        ;

        $total = (int) $countQuery->getQuery()->getSingleScalarResult();

        return new QueryList($threads, $total);
    }

    /**
     * @inheritDoc
     */
    public function getThreadById($threadId) {
        $thread = $this->repositories->threads()->find($threadId);

        if(!($thread instanceof Thread)) {
            throw new \OutOfBoundsException(sprintf('Thread with ID `%s` not found', $threadId));
        }

        return $thread;
    }

    /**
     * @inheritDoc
     */
    public function getThreadsByIds(array $threadIds) {
        return $threadEntities = $this->repositories->threads()->findBy([
            'id' => $threadIds
        ]);
    }

    /**
     * @inheritDoc
     */
    public function createNewThread($boardId, array $params) {
        $board = $this->repositories->boards()->find($boardId);

        if(!($board instanceof Board)) {
            throw new \OutOfBoundsException(sprintf('Board with ID `%s` not found', $boardId));
        }

        $thread = new Thread();
        $thread->setBoard($board);

        $post = new Post();
        $post->setEmail($params['post']['email']);
        $post->setAuthor($params['post']['author']);
        $post->setContent($params['post']['content']);
        $post->setThread($thread);

        $thread->getPosts()->add($post);

        $em = $this->repositories->getEntityManager();
        $em->persist($post);
        $em->persist($thread);
        $em->flush();

        return $thread;
    }
}