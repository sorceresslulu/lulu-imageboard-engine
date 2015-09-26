<?php
namespace Lulu\Imageboard\Domain\Entity\Thread;

use Lulu\Imageboard\Domain\Entity\Thread\Thread;

class ThreadList
{
    /**
     * Threads
     * @var Thread[]
     */
    protected $threads;

    /**
     * ThreadList constructor.
     * @param Thread[] $threads
     */
    public function __construct(array $threads) {
        $this->threads = $threads;
    }

    /**
     * Returns threads
     * @return Thread[]
     */
    public function getThreads() {
        return $this->threads;
    }
}