<?php
namespace Lulu\Imageboard\Util;

class QueryList
{
    /**
     * Items
     * @var array
     */
    private $items = [];

    /**
     * Total
     * @var int
     */
    private $total = 0;

    /**
     * QueryList constructor.
     * @param array $items
     * @param int $total
     */
    public function __construct(array $items, $total) {
        $this->items = $items;
        $this->total = $total;
    }

    /**
     * Returns items
     * @return array
     */
    public function getItems() {
        return $this->items;
    }

    /**
     * Returns total
     * @return int
     */
    public function getTotal() {
        return $this->total;
    }
}