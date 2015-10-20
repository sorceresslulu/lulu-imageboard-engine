<?php
namespace Lulu\Imageboard\Service\Upload\Component;

use Lulu\Imageboard\Service\Upload\Component\HandlerInterface;
use Lulu\Imageboard\Util\RequestFile;

class UploadRequest
{
    /**
     * Request File
     * @var RequestFile
     */
    private $file;

    /**
     * Handler
     * @var HandlerInterface
     */
    private $handler;

    /**
     * UploadDefinition constructor.
     * @param RequestFile $file
     * @param HandlerInterface $handler
     */
    public function __construct(RequestFile $file, HandlerInterface $handler) {
        $this->file = $file;
        $this->handler = $handler;
    }

    /**
     * Returns file
     * @return RequestFile
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * Returns handler
     * @return HandlerInterface
     */
    public function getHandler() {
        return $this->handler;
    }
}