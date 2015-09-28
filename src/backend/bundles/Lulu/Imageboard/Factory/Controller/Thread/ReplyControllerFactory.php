<?php
namespace Lulu\Imageboard\Factory\Controller\Thread;

use Lulu\Imageboard\Controller\Thread\ReplyController;
use Lulu\Imageboard\Service\REST\Thread\ThreadReplyRESTService;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class ReplyControllerFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var ThreadReplyRESTService $threadReplyRESTService */
        $threadReplyRESTService = $serviceManager->get('ThreadReplyRESTService');

        return new ReplyController($threadReplyRESTService);
    }
}