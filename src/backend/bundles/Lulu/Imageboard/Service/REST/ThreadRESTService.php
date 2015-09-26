<?php
namespace Lulu\Imageboard\Service\REST;

use League\Route\Http\Exception\NotFoundException;
use League\Route\Http\JsonResponse\Ok;
use Lulu\Imageboard\Domain\Entity\Thread;
use Lulu\Imageboard\Domain\Repository\BoardRepositoryInterface;
use Lulu\Imageboard\Domain\Repository\Thread\Component\ThreadListQuery;
use Lulu\Imageboard\Domain\Repository\ThreadRepositoryInterface;
use Lulu\Imageboard\Util\Seek\SeekableInterface;

class ThreadRESTService
{
    /**
     * Thread repository
     * @var ThreadRepositoryInterface
     */
    private $threadRepository;

    /**
     * Board repository
     * @var BoardRepositoryInterface
     */
    private $boardRepository;

    /**
     * ThreadRESTService constructor.
     * @param ThreadRepositoryInterface $threadRepository
     * @param BoardRepositoryInterface $boardRepository
     */
    public function __construct(ThreadRepositoryInterface $threadRepository, BoardRepositoryInterface $boardRepository) {
        $this->threadRepository = $threadRepository;
        $this->boardRepository = $boardRepository;
    }

    /**
     * Create new thread
     * @param $boardId
     * @param $params
     * @return Ok
     */
    public function createNewThread($boardId, $params) {
        $thread = $this->threadRepository->createNewThread($boardId, $params);

        return new Ok($this->convertThreadToJSON($thread));
    }

    /**
     * Returns thread by Id
     * @param $id
     * @return Ok
     * @throws NotFoundException
     */
    public function getById($id) {
        try {
            $thread = $this->threadRepository->getThreadById($id);
        } catch (\OutOfBoundsException $e) {
            throw new NotFoundException($e->getMessage());
        }

        return new Ok($this->convertThreadToJSON($thread));
    }

    /**
     * Returns threads by Ids
     * @param array $ids
     * @return Ok
     */
    public function getByIds(array $ids) {
        $jsonResponse = [];
        $threads = $this->threadRepository->getThreadsByIds($ids);

        foreach ($threads as $thread) {
            $jsonResponse[] = $this->convertThreadToJSON($thread);
        }

        return new Ok($jsonResponse);
    }

    /**
     * Returns threads by board
     * @param $boardId
     * @param SeekableInterface $seek
     * @return Ok
     */
    public function getByBoardId($boardId, SeekableInterface $seek) {
        $board = $this->boardRepository->getBoardById($boardId);

        $threadsQuery = new ThreadListQuery($board, $seek);
        $threadsQuery->withAllPosts();

        $threadsQueryList = $this->threadRepository->getThreads($threadsQuery);
        $jsonResponse = [
            'items' => [],
            'total' => $threadsQueryList->getTotal()
        ];

        foreach ($threadsQueryList->getItems() as $thread) {
            $jsonResponse['items'][] = $this->convertThreadToJSON($thread);
        }

        return new Ok($jsonResponse);
    }

    /**
     * Converts thread to JSON
     * @param Thread $thread
     * @return array
     */
    private function convertThreadToJSON(Thread $thread) {
        return [
            'id' => $thread->getId()
        ];
    }
}