<?php
namespace Lulu\Imageboard\Domain\Entity;

use Lulu\Imageboard\Util\Id;

class Board
{
    /**
     * Id
     * @var Id
     */
    private $id;

    /**
     * Url
     * @var string
     */
    private $url;

    /**
     * Title
     * @var string
     */
    private $title;

    /**
     * Description
     * @var string
     */
    private $description;

    /**
     * Board constructor.
     * @param mixed $id
     */
    public function __construct(Id $id) {
        $this->id = $id;
    }

    /**
     * Returns Id
     * @return Id
     */
    public function getId() {
        return $this->id;
    }
    /**
     * Returns url
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Set url
     * @param string $url
     */
    public function setUrl($url) {
        $this->url = $url;
    }

    /**
     * Returns title
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set title
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Returns description
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set description
     * @param string $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }
}