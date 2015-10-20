<?php
namespace Lulu\Imageboard\Factor\Service\Post;

use Lulu\Imageboard\Service\Post\Attachment\Upload\Detector\DetectorFactory;
use Lulu\Imageboard\Service\Post\Attachment\Upload\UploadService;
use Lulu\Imageboard\ServiceManager\FactoryInterface;
use Lulu\Imageboard\ServiceManager\ServiceManagerInterface;

class PostAttachmentUploadServiceFactory implements FactoryInterface
{
    public function createServiceInstance(ServiceManagerInterface $serviceManager) {
        $uploadService = new UploadService();

    }
}
