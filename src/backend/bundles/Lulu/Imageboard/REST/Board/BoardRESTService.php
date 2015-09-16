<?php
namespace Lulu\Imageboard\REST\Board;

use League\Route\Http\Exception\NotFoundException;
use League\Route\Http\JsonResponse\Ok;
use League\Route\RouteCollection;
use Lulu\Imageboard\Domain\Board\Board;
use Lulu\Imageboard\Repository\Mongo\BoardRepository;
use Lulu\Imageboard\REST\RESTServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BoardRESTService implements RESTServiceInterface
{
    /**
     * Board Repository
     * @var BoardRepository
     */
    private $boardRepository;

    /**
     * BoardRESTService constructor.
     * @param BoardRepository $boardRepository
     */
    public function __construct(BoardRepository $boardRepository) {
        $this->boardRepository = $boardRepository;
    }

    /**
     * @inheritdoc
     */
    public function initRoutes(RouteCollection $routes) {
        $routes->get('/backend/rest/boards/', function () {
            $jsonResponse = [];

            /** @var Board $board */
            foreach ($this->boardRepository->getAllBoards()->getBoards() as $board) {
                $jsonResponse[] = $this->boardToJSON($board);
            }

            return new Ok($jsonResponse);
        });

        $routes->get('/backend/rest/boards/{id}', function (Request $request, Response $response, array $args) {
            try {
                $board = $this->boardRepository->getBoardById($args['id']);
            } catch (\OutOfBoundsException $e) {
                throw new NotFoundException($e->getMessage());
            }

            return new Ok($this->boardToJSON($board));
        });
    }

    /**
     * Converts board to JSON
     * @param Board $board
     * @return array
     */
    private function boardToJSON(Board $board) {
        return [
            'id' => $board->getId(),
            'title' => $board->getTitle()
        ];
    }
}