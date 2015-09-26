<?php
namespace Lulu\Imageboard\Domain\Entity\Thread\Component;

use Lulu\Imageboard\Domain\Entity\Board\Board;
use Lulu\Imageboard\Util\Seek\SeekableInterface;

class ThreadListQuery
{
    const POSTS_MODE_NONE = 'none';
    const POSTS_MODE_ALL = 'all';
    const POSTS_MODE_HEAD = 'head';

    /**
     * Board
     * @var Board
     */
    private $board;

    /**
     * Seek
     * @var SeekableInterface
     */
    private $seek;

    /**
     * If true query should returns posts of thread
     * @var string
     */
    private $withPosts = self::POSTS_MODE_NONE;

    /**
     * ThreadListQuery constructor.
     * @param Board $board
     * @param SeekableInterface $seek
     */
    public function __construct(Board $board, SeekableInterface $seek) {
        $this->board = $board;
        $this->seek = $seek;
    }

    /**
     * Returns board
     * @return Board
     */
    public function getBoard() {
        return $this->board;
    }

    /**
     * Returns seek
     * @return SeekableInterface
     */
    public function getSeek() {
        return $this->seek;
    }

    /**
     * Returns posts mode
     * @return string
     */
    public function getPostsMode() {
        return $this->withPosts;
    }

    /**
     * With posts
     */
    public function withAllPosts() {
        $this->withPosts = self::POSTS_MODE_ALL;
    }

    public function withHeadPosts() {
        $this->withPosts = self::POSTS_MODE_HEAD;
    }

    /**
     * Without posts
     */
    public function withoutPosts() {
        $this->withPosts = self::POSTS_MODE_NONE;
    }

    /**
     * Posts mode
     * @return string
     */
    public function isWithPosts() {
        return $this->withPosts;
    }
}