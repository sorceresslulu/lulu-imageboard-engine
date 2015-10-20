<?php
namespace Lulu\Imageboard\Service\Post\Attachment\Upload\Handler;

use Lulu\Imageboard\Service\Upload\Component\HandlerInterface;
use Lulu\Imageboard\Util\RequestFile;

interface HandlerFactoryInterface
{
    /**
     * Create and returns handler by string code
     * @param $handlerStringCode
     * @param RequestFile $requestFile
     * @return HandlerInterface
     */
    public function createFromStringCode($handlerStringCode, RequestFile $requestFile);
}