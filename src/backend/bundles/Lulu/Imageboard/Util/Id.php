<?php
namespace Lulu\Imageboard\Util;

class Id
{
    /**
     * Id
     * @var mixed
     */
    private $id;

    /**
     * Id constructor.
     * @param mixed $id
     */
    public function __construct($id = null) {
        $this->id = $id;
    }

    /**
     * Define Id
     * @param $id
     * @throws \Exception
     */
    public function defineId($id) {
        if($this->isIdDefined()) {
            throw new \Exception(sprintf('Id is already defined to `%s`', (string) $this->id));
        }

        $this->id = $id;
    }

    /**
     * Returns true if Id is defined
     * @return bool
     */
    public function isIdDefined() {
        return $this->id !== null;
    }

    /**
     * Returns Id
     * @return mixed
     * @throws \Exception
     */
    public function getIdValue() {
        if(!($this->isIdDefined())) {
            throw new \Exception('Id is not defined');
        }

        return $this->id;
    }

    /**
     * @inheritDoc
     */
    function __toString() {
        return (string) $this->getIdValue();
    }
}