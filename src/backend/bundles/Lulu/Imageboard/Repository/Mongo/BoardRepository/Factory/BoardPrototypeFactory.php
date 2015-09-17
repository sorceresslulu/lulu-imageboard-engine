<?php
namespace Lulu\Imageboard\Repository\Mongo\BoardRepository\Factory;

use Lulu\Imageboard\Domain\Board\BoardList;
use Lulu\Imageboard\Domain\Board\BoardRepositoryInterface;
use Lulu\Imageboard\Domain\Thread\Factory\BoardPrototypeFactoryInterface;

class BoardPrototypeFactory implements BoardPrototypeFactoryInterface
{
    /**
     * Board repository
     * @var BoardRepositoryInterface
     */
    private $boardRepository;

    /**
     * Boards list
     * @var BoardList
     */
    private $boards = [];

    /**
     * Map id => board
     * @var array
     */
    private $idMap = [];

    /**
     * Flag "boards list is loaded"
     * @var bool
     */
    private $isLoaded = false;

    /**
     * BoardPrototypeFactory constructor.
     * @param BoardRepositoryInterface $boardRepository
     */
    public function __construct(BoardRepositoryInterface $boardRepository) {
        $this->boardRepository = $boardRepository;
    }

    /**
     * Load boards list
     */
    private function loadBoards() {
        $this->boards = $this->boardRepository->getAllBoards();
        $this->isLoaded = true;

        foreach($this->boards->getBoards() as $board) {
            $this->idMap[(string) $board->getId()] = $board;
        }
    }

    /**
     * @inheritDoc
     */
    public function getBoardById($id) {
        $id = (string) $id;

        if(!($this->isLoaded)) {
            $this->loadBoards();
        }

        if(!(isset($this->idMap[$id]))) {
            throw new \OutOfBoundsException(sprintf('Board with Id `%s` not found', $id));
        }

        return $this->idMap[$id];
    }
}