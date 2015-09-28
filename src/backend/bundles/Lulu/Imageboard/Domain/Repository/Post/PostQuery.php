<?php
namespace Lulu\Imageboard\Domain\Repository\Post;

use Lulu\Imageboard\Domain\Entity\Thread;
use Lulu\Imageboard\Util\Seek\SeekableInterface;

class PostQuery
{
    /**
     * Seek
     * @var SeekableInterface
     */
    private $seek;

    /**
     * Thread Id
     * @var int
     */
    private $threadId;

    /**
     * PostQuery constructor.
     * @param SeekableInterface $seek
     * @param int $threadId
     */
    public function __construct(SeekableInterface $seek, $threadId) {
        $this->seek = $seek;
        $this->threadId = $threadId;
    }

    /**
     * @return SeekableInterface
     */
    public function getSeek() {
        return $this->seek;
    }

    /**
     * @return int
     */
    public function getThreadId() {
        return $this->threadId;
    }
}