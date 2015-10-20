<?php
namespace Lulu\Imageboard\Service\Post\Attachment\Upload\Handler;

use Lulu\Imageboard\Service\Post\Attachment\Upload\Handler\Handlers\ImageHandler;
use Lulu\Imageboard\Service\Upload\Component\HandlerInterface;
use Lulu\Imageboard\Util\RequestFile;

class HandlerFactory implements HandlerFactoryInterface
{
    const HANDLER_IMAGE = 'image';
    const HANDLER_WEBM = 'webm';

    /**
     * Configuration
     * @var array
     */
    private $configuration = [];

    /**
     * BaseDir
     * @var string
     */
    private $baseDir;

    /**
     * HandlerFactory constructor.
     * @param array $configuration
     * @param string $baseDir
     */
    public function __construct(array $configuration, $baseDir) {
        $this->configuration = $configuration;
        $this->baseDir = $baseDir;
    }

    /**
     * Returns baseDir
     * @return string
     */
    public function getBaseDir() {
        return $this->baseDir;
    }

    /**
     * Create and returns handler by string code
     * @param $handlerStringCode
     * @param RequestFile $requestFile
     * @return HandlerInterface
     */
    public function createFromStringCode($handlerStringCode, RequestFile $requestFile) {
        switch($handlerStringCode) {
            default:
                throw new \OutOfBoundsException(sprintf('Unknown handler with code `%s`'< $handlerStringCode));

            case self::HANDLER_IMAGE:
                return $this->createImageHandler($requestFile);
        }
    }

    /**
     * Returns ImageHandler
     * @param RequestFile $requestFile
     * @return ImageHandler
     */
    protected function createImageHandler(RequestFile $requestFile) {
        $handlerConfiguration = $this->configuration['image'];

        $imageHandler = new ImageHandler($this->baseDir, $requestFile);
        $imageHandler->setMaxWidth($handlerConfiguration['full']['width']);
        $imageHandler->setMaxHeight($handlerConfiguration['full']['height']);
        $imageHandler->setMaxThumbnailHeight($handlerConfiguration['thumbnail']['height']);

        return $imageHandler;
    }
}