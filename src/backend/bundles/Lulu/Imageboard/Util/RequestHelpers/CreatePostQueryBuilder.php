<?php
namespace Lulu\Imageboard\Util\RequestHelpers;

use Lulu\Imageboard\Domain\Repository\Post\PostQuery;
use Lulu\Imageboard\Util\Seek\SeekFromRequest;
use Symfony\Component\HttpFoundation\Request;

class CreatePostQueryBuilder
{
    const DEFAULT_LIMIT = 1000;
    const DEFAULT_MAX_LIMIT = false;

    /**
     * Request
     * @var Request
     */
    private $request;

    /**
     * Max limit
     * @var bool|int
     */
    private $maxLimit = self::DEFAULT_MAX_LIMIT;

    /**
     * Default limit
     * @var int
     */
    private $defaultLimit = self::DEFAULT_LIMIT;

    /**
     * CreatePostQueryBuilder
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * Returns request
     * @return Request
     */
    public function getRequest() {
        return $this->request;
    }

    /**
     * Return max limit
     * @return int
     */
    public function getMaxLimit() {
        return $this->maxLimit;
    }

    /**
     * Set max limit
     * @param int|bool $maxLimit
     */
    public function setMaxLimit($maxLimit) {
        $this->maxLimit = $maxLimit;
    }

    /**
     * Returns default limit
     * @return int
     */
    public function getDefaultLimit() {
        return $this->defaultLimit;
    }

    /**
     * Set default limit
     * @param int $defaultLimit
     */
    public function setDefaultLimit($defaultLimit) {
        $this->defaultLimit = $defaultLimit;
    }

    /**
     * Create and returns PostQuery from request
     * @return PostQuery
     */
    public function build() {
        $threadId = $this->request->get('threadId');
        $seek = new SeekFromRequest($this->request, $this->maxLimit, $this->defaultLimit);

        return new PostQuery($seek, $threadId);
    }
}