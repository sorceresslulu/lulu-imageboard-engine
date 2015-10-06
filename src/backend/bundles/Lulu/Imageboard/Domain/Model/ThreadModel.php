<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\Domain\Entity\Thread;

class ThreadModel
{
    /**
     * Thread
     * @var Thread
     */
    private $thread;

    /**
     * Posts
     * @var ArrayCollection
     */
    private $posts;

    /**
     * ThreadModel constructor.
     * @param Thread $thread
     * @param ArrayCollection $posts
     */
    public function __construct(Thread $thread, ArrayCollection $posts) {
        $this->thread = $thread;
        $this->posts = $posts;
    }

    /**
     * Create and returns ThreadModel by thread Id
     * @param $threadId
     * @throws \Exception
     */
    public static function createByThreadId($threadId) {
        throw new \Exception('Not implemented');
    }

    /**
     * Reply
     * @param Post $post
     * @throws \Exception
     */
    public function reply(Post $post) {
        throw new \Exception('Not implemented');
    }
}