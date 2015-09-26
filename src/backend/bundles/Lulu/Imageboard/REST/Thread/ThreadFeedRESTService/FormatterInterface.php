<?php
namespace Lulu\Imageboard\REST\Thread\ThreadFeedRESTService;

use Lulu\Imageboard\Domain\Repository\Post\PostList;
use Lulu\Imageboard\Domain\Entity\Thread;

interface FormatterInterface
{
    /**
     * Format JSON response
     * @param Thread $thread
     * @return array
     */
    public function format(Thread $thread);
}