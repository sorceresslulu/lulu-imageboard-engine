<?php
namespace Lulu\Imageboard\Factory;

use League\Route\RouteCollection;
use Lulu\Imageboard\Controller\LeagueControllerStrategy;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class RouterFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        $router = new RouteCollection();
        $router->setStrategy(new LeagueControllerStrategy($serviceManager));

        $this->setupRESTBoard($router);
        $this->setupRESTThread($router);
        $this->setupRESTThreadFeed($router);
        $this->setupRESTPost($router);

        return $router;
    }

    /**
     * REST – Board
     * @param $router
     */
    protected function setupRESTBoard(RouteCollection $router) {
        $router->get('/backend/rest/board', 'Board\IndexController::getAll');
        $router->get('/backend/rest/board/{id}', 'Board\IndexController::getById');
    }

    /**
     * REST – Thread
     * @param $router
     */
    protected function setupRESTThread(RouteCollection $router) {
        $router->post('/backend/rest/thread/create/', 'Thread\IndexController::createNewThread');
        $router->get('/backend/rest/thread/{id}', 'Thread\IndexController::getById');
        $router->get('/backend/rest/thread/by-ids/{ids}', 'Thread\IndexController::getByIds');
        $router->get('/backend/rest/thread/by-board/{boardId}', 'Thread\IndexController::getByBoardId');
    }

    /**
     * REST – ThreadFeed
     * @param $router
     */
    protected function setupRESTThreadFeed(RouteCollection $router) {
        $router->get('/backend/rest/thread/feed/{id}', 'Thread\FeedController::getFeed');
    }

    /**
     * REST – Post
     * @param $router
     */
    protected function setupRESTPost(RouteCollection $router) {
        $router->get('/backend/rest/post/{id}', 'Post\IndexController::getById');
        $router->get('/backend/rest/post/by-ids/{ids}', 'Post\IndexController::getByIds');
        $router->get('/backend/rest/post/query/', 'Post\IndexController::getByQuery');
    }
}