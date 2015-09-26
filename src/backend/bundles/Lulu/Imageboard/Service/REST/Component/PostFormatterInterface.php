<?php
namespace Lulu\Imageboard\Service\REST\Component;

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