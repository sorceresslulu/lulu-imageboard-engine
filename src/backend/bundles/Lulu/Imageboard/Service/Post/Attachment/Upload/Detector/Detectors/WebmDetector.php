<?php
namespace Lulu\Imageboard\Service\Post\Attachment\Upload\Detector\Detectors;

use Lulu\Imageboard\Service\Post\Attachment\Upload\Detector\DetectorInterface;
use Lulu\Imageboard\Service\Post\Attachment\Upload\Handler\HandlerFactoryInterface;
use Lulu\Imageboard\Util\RequestFile;

class WebmDetector implements DetectorInterface
{
    /**
     * @inheritDoc
     */
    public function detect(HandlerFactoryInterface $handlerFactory, RequestFile $requestFile) {
        $testIsWebM = in_array($requestFile->getType(), ['video/webm', 'audio/webm'], true);

        if($testIsWebM) {
            return $handlerFactory->createFromStringCode('webm', $requestFile);
        }

        return false;
    }
}