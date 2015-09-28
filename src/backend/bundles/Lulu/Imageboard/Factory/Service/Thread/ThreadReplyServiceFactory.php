<?php
namespace Lulu\Imageboard\Factory\Service\Thread;

use Lulu\Imageboard\Domain\Repository\PostRepositoryInterface;
use Lulu\Imageboard\Domain\Repository\ThreadRepositoryInterface;
use Lulu\Imageboard\Service\Thread\Reply\ThreadReplyService;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class ThreadReplyServiceFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var ThreadRepositoryInterface $threadRepository */
        $threadRepository = $serviceManager->get('ThreadRepository');
        /** @var PostRepositoryInterface $postRepository */
        $postRepository = $serviceManager->get('PostRepository');

        return new ThreadReplyService($threadRepository, $postRepository);
    }
}