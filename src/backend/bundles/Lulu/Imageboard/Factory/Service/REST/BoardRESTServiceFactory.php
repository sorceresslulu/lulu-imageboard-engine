<?php
namespace Lulu\Imageboard\Factory\Service\REST;

use Lulu\Imageboard\Domain\Repository\BoardRepositoryInterface;
use Lulu\Imageboard\Service\REST\BoardRESTService;
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