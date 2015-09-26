<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Doctrine\Converter;

use Lulu\Imageboard\Application\DoctrineApplication\Doctrine\Entity\Thread as ThreadEntity;
use Lulu\Imageboard\Domain\Entity\Thread;
use Lulu\Imageboard\Domain\Repository\Post\PostList;
use Lulu\Imageboard\Util\Id;

class ThreadConverter
{
    public function extract(ThreadEntity $threadEntity) {
        if($threadEntity->getId()) {
            $id = new Id($threadEntity->getId());
        }else{
            $id = new Id();
        }

        $thread = new Thread($id);

        $board = $this->extractBoard($threadEntity);
        $posts = $this->extractPosts($threadEntity, $thread);

        $thread->setBoard($board);
        $thread->setPosts($posts);

        return $thread;
    }

    /**
     * @param ThreadEntity $threadEntity
     * @param Thread $thread
     * @return PostList
     */
    protected function extractPosts(ThreadEntity $threadEntity, Thread $thread) {
        $posts = [];
        $postConverter = new PostConverter();

        foreach ($threadEntity->getPosts() as $postEntity) {
            $posts[] = $postConverter->extract($postEntity, $thread);
        }

        return new PostList($posts);
    }

    /**
     * @param ThreadEntity $threadEntity
     * @return \Lulu\Imageboard\Domain\Entity\Board
     */
    protected function extractBoard(ThreadEntity $threadEntity) {
        $boardConverter = new BoardConverter();
        $board = $boardConverter->extract($threadEntity->getBoard());

        return $board;
    }
}