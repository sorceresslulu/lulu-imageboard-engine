<?php
namespace Lulu\Imageboard\Factory\Service\Thread;

use Doctrine\ORM\EntityManager;
use Lulu\Imageboard\Domain\Repository\ThreadRepositoryInterface;
use Lulu\Imageboard\Service\Post\Attachment\Upload\UploadService;
use Lulu\Imageboard\Service\Thread\Reply\ThreadReplyService;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class ThreadReplyServiceFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        /** @var ThreadRepositoryInterface $threadRepository */
        $threadRepository = $serviceManager->get('ThreadRepository');
        /** @var UploadService $postAttachmentUploadService */
        $postAttachmentUploadService = $serviceManager->get('PostAttachmentUploadService');
        /** @var EntityManager $entityManager */
        $entityManager = $serviceManager->get('EntityManager');

        return new ThreadReplyService($entityManager, $threadRepository, $postAttachmentUploadService);
    }
}