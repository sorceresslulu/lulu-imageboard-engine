<?php
namespace Lulu\Imageboard\Factory\Controller\Thread;

use Lulu\Imageboard\Controller\Thread\FeedController;
use Lulu\Imageboard\Service\REST\Thread\ThreadFeedRESTService;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class FeedControllerFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var ThreadFeedRESTService $threadFeedRESTService */
        $threadFeedRESTService = $serviceManager->get('ThreadFeedRESTService');

        return new FeedController($threadFeedRESTService);
    }
}