<?php
namespace Lulu\Imageboard\Util\Seek;

use Symfony\Component\HttpFoundation\Request;

class SeekFromRequest extends Seek
{
    /**
     * Create seek from Request object
     * @param Request $request
     * @param int $maxLimit
     * @param int $defaultLimit
     */
    public function __construct(Request $request, $maxLimit, $defaultLimit) {
        $this->setMaxLimit($maxLimit);
        $this->setOffset((int) $request->get('offset', 0));
        $this->setLimit((int) $request->get('limit', $defaultLimit));
    }
}