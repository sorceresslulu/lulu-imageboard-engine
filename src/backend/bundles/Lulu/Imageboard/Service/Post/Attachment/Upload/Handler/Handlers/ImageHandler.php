<?php
namespace Lulu\Imageboard\Service\Post\Attachment\Upload\Handler\Handlers;

use Lulu\Imageboard\Service\Post\Attachment\Upload\Handler\Handlers\AbstractHandler;

class ImageHandler extends AbstractHandler
{
    /**
     * Max Height
     * @var int
     */
    private $maxWidth = 1200;

    /**
     * Max Height
     * @var int
     */
    private $maxHeight = 1000;

    /**
     * Max Thumbnail Width
     * @var int
     */
    private $maxThumbnailWidth = 250;

    /**
     * Max Thumbnail Height
     * @var int
     */
    private $maxThumbnailHeight = 250;

    /**
     * @inheritDoc
     */
    public function validate() {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function process() {
        throw new \Exception('Not implemented');
    }

    /**
     * Returns Max Width
     * @return int
     */
    public function getMaxWidth() {
        return $this->maxWidth;
    }

    /**
     * Set Max Width
     * @param int $maxWidth
     */
    public function setMaxWidth($maxWidth) {
        $this->maxWidth = $maxWidth;
    }

    /**
     * @return int
     */
    public function getMaxHeight() {
        return $this->maxHeight;
    }

    /**
     * @param int $maxHeight
     */
    public function setMaxHeight($maxHeight) {
        $this->maxHeight = $maxHeight;
    }

    /**
     * @return int
     */
    public function getMaxThumbnailWidth() {
        return $this->maxThumbnailWidth;
    }

    /**
     * @param int $maxThumbnailWidth
     */
    public function setMaxThumbnailWidth($maxThumbnailWidth) {
        $this->maxThumbnailWidth = $maxThumbnailWidth;
    }

    /**
     * @return int
     */
    public function getMaxThumbnailHeight() {
        return $this->maxThumbnailHeight;
    }

    /**
     * @param int $maxThumbnailHeight
     */
    public function setMaxThumbnailHeight($maxThumbnailHeight) {
        $this->maxThumbnailHeight = $maxThumbnailHeight;
    }
}