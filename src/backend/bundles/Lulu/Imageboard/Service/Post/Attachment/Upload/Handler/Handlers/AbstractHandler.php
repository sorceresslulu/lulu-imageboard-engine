<?php
namespace Lulu\Imageboard\Service\Post\Attachment\Upload\Handler\Handlers;

use Lulu\Imageboard\Service\Upload\Component\HandlerInterface;
use Lulu\Imageboard\Util\RequestFile;

abstract class AbstractHandler implements HandlerInterface
{
    /**
     * BaseDir
     * @var string
     */
    protected $baseDir;

    /**
     * Request File
     * @var RequestFile
     */
    protected $file;

    /**
     * AbstractHandler constructor.
     * @param string $baseDir
     * @param RequestFile $file
     */
    public function __construct($baseDir, RequestFile $file) {
        $this->baseDir = $baseDir;
        $this->file = $file;
    }

    /**
     * Returns baseDir
     * @return string
     */
    public function getBaseDir() {
        return $this->baseDir;
    }

    /**
     * Returns file
     * @return RequestFile
     */
    public function getFile() {
        return $this->file;
    }
}