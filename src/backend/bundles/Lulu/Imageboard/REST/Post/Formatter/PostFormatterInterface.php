<?php
namespace Lulu\Imageboard\REST\Post\Formatter;

use Lulu\Imageboard\Domain\Entity\Post;

interface PostFormatterInterface
{
    /**
     * Converts Post o JSON
     * @param Post $post
     * @return mixed
     */
    public function format(Post $post);
}