<?php
namespace Lulu\Imageboard\Util\Seek;

class Seek implements SeekableInterface
{
    const DEFAULT_LIMIT = 10;

    /**
     * Offset
     * @var int
     */
    private $offset;

    /**
     * Limit
     * @var int
     */
    private $limit;

    /**
     * Maximum limit
     * @var int
     */
    private $maxLimit;

    /**
     * Seek constructor.
     * @param int|bool $maxLimit
     * @param int $offset
     * @param int $limit
     */
    public function __construct($maxLimit, $offset = 0, $limit = self::DEFAULT_LIMIT) {
        $this
            ->setMaxLimit($maxLimit)
            ->setLimit($limit)
            ->setOffset($offset)
        ;
    }

    /**
     * Returns max limit
     * @return int
     */
    public final function getMaxLimit() {
        return $this->maxLimit;
    }

    /**
     * Set max limit
     * @param int $maxLimit
     * @return $this
     */
    public final function setMaxLimit($maxLimit) {
        $this->testMaxLimit($maxLimit);
        $this->maxLimit = $maxLimit;

        return $this;
    }

    /**
     * Returns true if maxLimit is set
     * @return bool
     */
    public final function hasMaxLimit() {
        return $this->maxLimit !== false;
    }

    /**
     * @inheritdoc
     */
    public final function getOffset() {
        return $this->offset;
    }

    /**
     * @inheritdoc
     */
    public final function setOffset($offset) {
        $this->testOffset($offset);
        $this->offset = $offset;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public final function getLimit() {
        return $this->limit;
    }

    /**
     * @inheritdoc
     */
    public final function setLimit($limit) {
        $this->testLimit($limit);
        $this->limit = $limit;

        return $this;
    }

    /**
     * Test maxLimit
     * @param $maxLimit
     */
    private function testMaxLimit($maxLimit) {
        if($maxLimit === false) {
            return;
        }

        $testIsInt = is_int($maxLimit);
        $testIsPositive = $maxLimit > 0;

        if(!($testIsInt && $testIsPositive)) {
            throw new \InvalidArgumentException(sprintf('Invalid offset, expected positive integer, got `%s`', var_export($maxLimit, true)));
        }
    }

    /**
     * Test offset
     * @param $offset
     */
    private function testOffset($offset) {
        $testIsInt = is_int($offset);
        $testIsPositive = $offset >= 0;

        if(!($testIsInt && $testIsPositive)) {
            throw new \InvalidArgumentException(sprintf('Invalid offset, expected positive integer, got `%s`', var_export($offset, true)));
        }
    }

    /**
     * Test limit
     * @param $limit
     */
    private function testLimit($limit) {
        $testIsInt = is_int($limit);
        $testIsPositive = $limit > 0;

        if(!($testIsInt && $testIsPositive)) {
            throw new \InvalidArgumentException(sprintf('Invalid limit, expected positive integer, got `%s`', var_export($limit, true)));
        }

        if($this->hasMaxLimit()) {
            if($limit > $this->getMaxLimit()) {
                throw new \InvalidArgumentException(sprintf("Limit too big, maxium %d is allowed", $this->getMaxLimit()));
            }
        }
    }
}