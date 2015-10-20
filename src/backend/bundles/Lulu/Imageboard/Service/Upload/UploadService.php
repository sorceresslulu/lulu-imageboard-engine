<?php
namespace Lulu\Imageboard\Service\Upload;

use Lulu\Imageboard\Service\Upload\Component\UploadRequest;

class UploadService
{
    public function process(UploadRequest $request) {
        $request->getHandler()->process();
    }
}