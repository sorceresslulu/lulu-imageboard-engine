<?php
namespace Lulu\Imageboard\Factory\REST\Board;

use Lulu\Imageboard\Repository\Mongo\BoardRepository;
use Lulu\Imageboard\REST\Board\BoardRESTService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BoardRESTServiceFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        /** @var BoardRepository $boardRepository */
        $boardRepository = $serviceLocator->get('Lulu\Imageboard\Domain\Board\Repository');

        return new BoardRESTService($boardRepository);
    }
}