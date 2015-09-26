<?php
namespace Lulu\Imageboard\Service\REST\Component;

use Lulu\Imageboard\Domain\Repository\Post\PostList;
use Lulu\Imageboard\Domain\Entity\Thread;

interface ThreadFeedFormatterInterface
{
    /**
     * Format JSON response
     * @param Thread $thread
     * @return array
     */
    public function format(Thread $thread);
}