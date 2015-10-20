<?php
namespace Lulu\Imageboard\Service\Post\Attachment\Upload;

use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\Service\Post\Attachment\Upload\Detector\DetectorInterface;
use Lulu\Imageboard\Service\Post\Attachment\Upload\Handler\HandlerFactoryInterface;
use Lulu\Imageboard\Util\RequestFile;

class UploadService
{
    /**
     * Detectors
     * @var DetectorInterface[]
     */
    private $detectors;

    /**
     * Handler Factory
     * @var HandlerFactoryInterface
     */
    private $handlerFactory;



    /**
     * Create and returns query
     * @param Post $post
     * @param RequestFile[] $files
     * @return Query
     * @throws \Exception
     */
    public function createQuery(Post $post, array $files) {
        $uploadDefinitions = [];

        foreach($files as $requestFile) {
            $handlerFound = false;

            foreach($this->detectors as $detector) {
                if($handler = $detector->detect($this->handlerFactory, $requestFile)) {
                    $uploadDefinitions[] = $handler;
                    $handlerFound = true;
                    break;
                }
            }

            if(!($handlerFound)) {
                throw new \Exception(sprintf('No detector found for file'));
            }
        }

        return new Query($post, $uploadDefinitions);
    }
}