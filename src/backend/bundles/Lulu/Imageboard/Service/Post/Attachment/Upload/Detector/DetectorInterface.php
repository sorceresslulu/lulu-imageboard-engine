<?php
namespace Lulu\Imageboard\Service\Post\Attachment\Upload\Detector;

use Lulu\Imageboard\Service\Post\Attachment\Upload\Handler\HandlerFactoryInterface;
use Lulu\Imageboard\Util\RequestFile;

interface DetectorInterface
{
    public function detect(HandlerFactoryInterface $handlerFactory, RequestFile $requestFile);
}