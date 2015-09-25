<?php
namespace Lulu\Imageboard\Util;

class QueryListJSONFormatter
{
    /**
     * Query List
     * @var QueryList
     */
    private $queryList;

    /**
     * QueryListJSONFormatter constructor.
     * @param QueryList $queryList
     */
    public function __construct(QueryList $queryList) {
        $this->queryList = $queryList;
    }

    /**
     * Returns JSON response
     * @return array
     */
    public function format() {
        return [
            'total' => $this->queryList->getTotal(),
            'items' => $this->queryList->getItems()
        ];
    }
}