<?php
namespace Lulu\Imageboard\Application\MysqlApplication\Domain\Entity\Board;

use Lulu\Imageboard\Domain\Entity\Board\Board;
use Lulu\Imageboard\Domain\Entity\Board\BoardList;
use Lulu\Imageboard\Domain\Entity\Board\BoardRepositoryInterface;

class BoardRepository implements BoardRepositoryInterface
{
    /**
     * Mysqli
     * @var \mysqli
     */
    private $mysqli;

    /**
     * BoardRepository constructor.
     * @param \mysqli $mysqli
     */
    public function __construct(\mysqli $mysqli) {
        $this->mysqli = $mysqli;
    }

    /**
     * @inheritDoc
     */
    public function getBoardById($id) {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function getAllBoards() {
        throw new \Exception('Not implemented');
    }
}