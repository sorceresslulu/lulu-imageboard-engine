<?php
namespace Lulu\Imageboard\Factory\REST;

use Lulu\Imageboard\Domain\Entity\Board\BoardRepositoryInterface;
use Lulu\Imageboard\Domain\Entity\Thread\ThreadRepositoryInterface;
use Lulu\Imageboard\REST\Thread\ThreadRESTService;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class ThreadRESTServiceFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var ThreadRepositoryInterface $threadRepository */
        $threadRepository = $serviceManager->get('ThreadRepository');
        /** @var BoardRepositoryInterface $boardRepository */
        $boardRepository = $serviceManager->get('BoardRepository');

        return new ThreadRESTService($threadRepository, $boardRepository);
    }
}