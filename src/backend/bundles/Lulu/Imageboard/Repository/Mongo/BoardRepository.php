<?php
namespace Lulu\Imageboard\Repository\Mongo;

use Lulu\Imageboard\Domain\Board\Board;
use Lulu\Imageboard\Domain\Board\BoardList;
use Lulu\Imageboard\Domain\Board\RepositoryInterface;

class BoardRepository implements RepositoryInterface
{
    /**
     * Boards Mongo Collection
     * @var \MongoCollection
     */
    private $boardsMongoCollection;

    /**
     * BoardRepository constructor.
     * @param \MongoCollection $boardsMongoCollection
     */
    public function __construct(\MongoCollection $boardsMongoCollection) {
        $this->boardsMongoCollection = $boardsMongoCollection;
    }

    /**
     * @inheritdoc
     */
    public function getBoardById($id) {
        $boardBSON = $this->boardsMongoCollection->findOne(['_id' => new \MongoId($id)]);

        if (!($boardBSON)) {
            throw new \OutOfBoundsException(sprintf('Board with Id `%s` not found', (string)$id));
        }

        return $this->createBoardFromBSON($boardBSON);
    }

    /**
     * @inheritdoc
     */
    public function getAllBoards() {
        $boards = [];

        foreach ($this->boardsMongoCollection->find() as $boardBSON) {
            $boards[] = $this->createBoardFromBSON($boardBSON);
        }

        return new BoardList($boards);
    }

    /**
     * Create and returns Board from BSON
     * @param array $boardBSON
     * @return Board
     */
    private function createBoardFromBSON(array $boardBSON) {
        return new Board(
            $boardBSON['_id'],
            $boardBSON['title']
        );
    }
}