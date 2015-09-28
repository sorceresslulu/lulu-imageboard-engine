<?php
namespace Lulu\Imageboard\Service\REST;

use League\Route\Http\Exception\NotFoundException;
use League\Route\Http\JsonResponse\Ok;
use Lulu\Imageboard\Domain\Repository\PostRepositoryInterface;
use Lulu\Imageboard\Domain\Repository\ThreadRepositoryInterface;
use Lulu\Imageboard\Service\REST\Component\ThreadFeedFormatter;

class ThreadFeedRESTService
{
    /**
     * Thread Repository
     * @var ThreadRepositoryInterface
     */
    private $threadRepository;

    /**
     * Post Repository
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * ThreadFeedRESTService constructor.
     * @param ThreadRepositoryInterface $threadRepository
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(ThreadRepositoryInterface $threadRepository, PostRepositoryInterface $postRepository) {
        $this->threadRepository = $threadRepository;
        $this->postRepository = $postRepository;
    }

    /**
     * Returns thread feed
     * @param $threadId
     * @return Ok
     * @throws NotFoundException
     */
    public function getFeed($threadId) {
        $formatter = new ThreadFeedFormatter();

        try {
            $thread = $this->threadRepository->getThreadById($threadId);

            return new Ok($formatter->format($thread));
        } catch (\OutOfBoundsException $e) {
            throw new NotFoundException($e->getMessage());
        }
    }
}