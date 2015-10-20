<?php
namespace Lulu\Imageboard\Service\Upload\Component;

use Lulu\Imageboard\Service\Upload\Exceptions\ValidatorException;
use Lulu\Imageboard\Util\RequestFile;

interface HandlerInterface
{
    /**
     * Returns file
     * @return mixed
     */
    public function getFile();

    /**
     * Returns base directory
     * @return string
     */
    public function getBaseDir();

    /**
     * Validate file
     * @throws ValidatorException
     */
    public function validate();

    /**
     * Process (upload) file
     * Returns some attachment info
     * @return array
     */
    public function process();
}