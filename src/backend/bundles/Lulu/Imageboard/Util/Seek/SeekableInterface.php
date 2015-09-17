<?php
namespace Lulu\Imageboard\Util\Seek;

interface SeekableInterface
{
    /**
     * Returns offset
     * @return int
     */
    public function getOffset();

    /**
     * Set offset
     * @return $this
     */
    public function setOffset($offset);

    /**
     * Returns limit
     * @return int
     */
    public function getLimit();

    /**
     * Set limit
     * @param $limit
     * @return $this
     */
    public function setLimit($limit);
}