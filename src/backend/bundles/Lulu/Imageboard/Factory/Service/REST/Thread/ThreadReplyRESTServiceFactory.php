<?php
namespace Lulu\Imageboard\Factory\Service\REST\Thread;

use Lulu\Imageboard\Service\REST\Thread\ThreadReplyRESTService;
use Lulu\Imageboard\Service\Thread\Reply\ThreadReplyService;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class ThreadReplyRESTServiceFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var ThreadReplyService $threadReplyService */
        $threadReplyService = $serviceManager->get('ThreadReplyService');

        return new ThreadReplyRESTService($threadReplyService);
    }
}