<?php
namespace Lulu\Imageboard\REST\Board;

use League\Route\Http\JsonResponse\Ok;
use League\Route\RouteCollection;
use Lulu\Imageboard\Domain\Board\Board;
use Lulu\Imageboard\Repository\Mongo\BoardRepository;
use Lulu\Imageboard\REST\RESTServiceInterface;

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
        $routes->get('/rest/boards/', function() {
            $jsonResponse = [];

            /** @var Board $board */
            foreach($this->boardRepository->getAllBoards()->getBoards() as $board) {
                $jsonResponse[] = [
                    'id' => $board->getId(),
                    'title' => $board->getTitle()
                ];
            }

            return new Ok($jsonResponse);
        });
    }
}