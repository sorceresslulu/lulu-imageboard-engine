<?php
namespace Lulu\Imageboard\Service\REST;

use League\Route\Http\Exception\NotFoundException;
use League\Route\Http\JsonResponse\Ok;
use Lulu\Imageboard\Domain\Entity\Board;
use Lulu\Imageboard\Domain\Repository\BoardRepositoryInterface;

class BoardRESTService
{
    /**
     * Board Repository
     * @var BoardRepositoryInterface
     */
    private $boardRepository;

    /**
     * BoardRESTService constructor.
     * @param BoardRepositoryInterface $boardRepository
     */
    public function __construct(BoardRepositoryInterface $boardRepository) {
        $this->boardRepository = $boardRepository;
    }

    /**
     * Returns board by Id
     * @param int $id
     * @return Ok
     * @throws NotFoundException
     */
    public function getById($id) {
        try {
            $board = $this->boardRepository->getBoardById($id);
        } catch (\OutOfBoundsException $e) {
            throw new NotFoundException($e->getMessage());
        }

        return new Ok($this->boardToJSON($board));
    }

    /**
     * Returns list of boards
     * @return Ok
     */
    public function getAll() {
        $jsonResponse = [];

        /** @var Board $board */
        foreach ($this->boardRepository->getAllBoards() as $board) {
            $jsonResponse[] = $this->boardToJSON($board);
        }

        return new Ok($jsonResponse);
    }

    /**
     * Converts board to JSON
     * @param Board $board
     * @return array
     */
    private function boardToJSON(Board $board) {
        return [
            'sId' => (string) $board->getId(),
            'url' => $board->getUrl(),
            'title' => $board->getTitle(),
            'description' => $board->getDescription()
        ];
    }
}