<?php
namespace Lulu\Imageboard\Util;

class DateMarks
{
    /**
     * Created on
     * @var \DateTime
     */
    private $createdOn;

    /**
     * Updated on
     * @var \DateTime
     */
    private $updatedOn;

    /**
     * DateMarks constructor.
     * @param \DateTime $createdOn
     * @param \DateTime $updatedOn
     */
    public function __construct(\DateTime $createdOn = null, \DateTime $updatedOn = null) {
        if($createdOn === null) {
            $createdOn = new \DateTime();
        }

        $this->createdOn = $createdOn;
        $this->updatedOn = $updatedOn;
    }

    /**
     * Set Created On
     * @param \DateTime $createdOn
     */
    public function setCreatedOn($createdOn) {
        $this->createdOn = $createdOn;
    }

    /**
     * Returns Created On
     * @return \DateTime
     */
    public function getCreatedOn() {
        return $this->createdOn;
    }

    /**
     * Returns Updated On
     * Can throw an exception if Updated on wasn't set
     * @return \DateTime
     * @throws \Exception
     */
    public function getUpdatedOn() {
        if(!($this->wasUpdated())) {
            throw new \Exception('No DateUpdated available');
        }

        return $this->updatedOn;
    }

    /**
     * Set Updated On
     * @param \DateTime $updatedOn
     */
    public function setUpdatedOn($updatedOn) {
        $this->updatedOn = $updatedOn;
    }

    /**
     * Return true if Updated on is set
     * @return bool
     */
    public function wasUpdated() {
        return $this->updatedOn !== null;
    }
}