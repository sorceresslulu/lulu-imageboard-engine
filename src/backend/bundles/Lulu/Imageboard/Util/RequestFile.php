<?php
namespace Lulu\Imageboard\Util;

class RequestFile
{
    /**
     * Base64
     * @var string
     */
    private $data;

    /**
     * Decoded base64 data
     * Lazy Load
     * @var string
     */
    private $decodedData;

    /**
     * Last Modified
     * @var int
     */
    private $lastModified;

    /**
     * Last Modified (string)
     * @var string
     */
    private $lastModifiedDate;

    /**
     * Size
     * @var int
     */
    private $size;

    /**
     * Type
     * @var string
     */
    private $type;

    /**
     * RequestFile constructor.
     * @param string $data
     * @param int $lastModified
     * @param string $lastModifiedDate
     */
    public function __construct($data, $lastModified, $lastModifiedDate) {
        $this->data = $data;
        $this->lastModified = $lastModified;
        $this->lastModifiedDate = $lastModifiedDate;
    }

    /**
     * Create and returns RequestFile from array
     * @param array $data
     * @return RequestFile
     */
    public static function createFromRequest(array $data) {
        return new self(
            $data['data'],
            (int) $data['lastModified'],
            $data['lastModifiedDate']
        );
    }

    /**
     * Returns raw base64 data
     * @return string
     */
    public function getData() {
        return $this->data;
    }

    /**
     * Returns decoded file
     * @return string
     */
    public function getDecodedData() {
        if($this->decodedData === null) {
            list(, $data)      = explode(',', $this->data);
            $this->decodedData = base64_decode($data);
        }

        return $this->decodedData;
    }

    /**
     * Returns last modified (as Integer)
     * @return int
     */
    public function getLastModifiedInteger() {
        return $this->lastModified;
    }

    /**
     * Returns last  modified (as String)
     * @return string
     */
    public function getLastModifiedString() {
        return $this->lastModifiedDate;
    }

    /**
     * Returns last modified (as DateTime)
     * @return \DateTime
     */
    public function getLastModifiedDateTime() {
        return \DateTime::createFromFormat($this->lastModified, \DateTime::ISO8601);
    }

    /**
     * Returns size
     * @return int
     */
    public function getSize() {
        if($this->size === null) {
            $this->size = count($this->getDecodedData());
        }

        return $this->size;
    }

    /**
     * Returns type
     * @return string
     */
    public function getType() {
        if($this->type === null) {
            $f = finfo_open();

            $this->type = finfo_buffer($f, $this->getDecodedData(), FILEINFO_MIME_TYPE);
        }


        return $this->type;
    }
}