<?php
namespace Lulu\Imageboard\Factory\REST\Board;

use Lulu\Imageboard\Domain\Board\BoardRepositoryInterface;
use Lulu\Imageboard\REST\Board\BoardRESTService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BoardRESTServiceFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        /** @var BoardRepositoryInterface $boardRepository */
        $boardRepository = $serviceLocator->get('Lulu\Imageboard\Domain\Board\BoardRepository');

        return new BoardRESTService($boardRepository);
    }
}