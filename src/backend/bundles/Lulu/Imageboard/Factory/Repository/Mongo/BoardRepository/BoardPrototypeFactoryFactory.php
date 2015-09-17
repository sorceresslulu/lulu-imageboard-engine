<?php
namespace Lulu\Imageboard\Factory\Repository\Mongo\BoardRepository;

use Lulu\Imageboard\Repository\Mongo\BoardRepository;
use Lulu\Imageboard\Repository\Mongo\BoardRepository\Factory\BoardPrototypeFactory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BoardPrototypeFactoryFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        /** @var BoardRepository $boardRepository */
        $boardRepository = $serviceLocator->get('Lulu\Imageboard\Domain\Board\BoardRepository');

        return new BoardPrototypeFactory($boardRepository);
    }
}