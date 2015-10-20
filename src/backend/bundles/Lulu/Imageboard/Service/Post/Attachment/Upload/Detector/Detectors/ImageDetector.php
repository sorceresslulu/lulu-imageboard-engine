<?php
namespace Lulu\Imageboard\Service\Post\Attachment\Upload\Detector\Detectors;

use Lulu\Imageboard\Service\Post\Attachment\Upload\Detector\DetectorInterface;
use Lulu\Imageboard\Service\Post\Attachment\Upload\Handler\HandlerFactoryInterface;
use Lulu\Imageboard\Util\RequestFile;

class ImageDetector implements DetectorInterface
{
    /**
     * Allowed MIME types
     * @var string[]
     */
    private $allowedMIMETypes = [];

    /**
     * ImageDetector constructor.
     * @param \string[] $allowedMIMETypes
     */
    public function __construct(array $allowedMIMETypes) {
        $this->allowedMIMETypes = $allowedMIMETypes;
    }

    /**
     * @inheritDoc
     */
    public function detect(HandlerFactoryInterface $handlerFactory, RequestFile $requestFile) {
        $testIsImage = in_array($requestFile->getType(), $this->allowedMIMETypes, true);

        if($testIsImage) {
            return $handlerFactory->createFromStringCode('image', $requestFile);
        }

        return false;
    }

    /**
     * Returns allowed MIME types
     * @return \string[]
     */
    public function getAllowedMIMETypes() {
        return $this->allowedMIMETypes;
    }
}