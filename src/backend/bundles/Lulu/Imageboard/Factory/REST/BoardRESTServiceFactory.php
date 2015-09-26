<?php
namespace Lulu\Imageboard\Factory\REST;

use Lulu\Imageboard\Domain\Entity\Board\BoardRepositoryInterface;
use Lulu\Imageboard\REST\Board\BoardRESTService;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class BoardRESTServiceFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var BoardRepositoryInterface $boardRepository */
        $boardRepository = $serviceManager->get('BoardRepository');

        return new BoardRESTService($boardRepository);
    }
}