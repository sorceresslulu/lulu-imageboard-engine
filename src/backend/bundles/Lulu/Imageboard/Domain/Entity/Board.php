<?php
namespace Lulu\Imageboard\Domain\Entity;

/**
 * @Entity
 * @Table(name="board")
 */
class Board
{
    /**
     * Id
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * Url
     * @Column(type="string")
     * @var string
     */
    protected $url;

    /**
     * Title
     * @Column(type="string")
     * @var string
     */
    protected $title;

    /**
     * Description
     * @Column(type="text")
     * @var string
     */
    protected $description;

    /**
     * Features
     * @Column(type="json_array")
     * @var array
     */
    protected $features;

    /**
     * Returns Id
     * @return int
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

    /**
     * Returns features
     * @return array
     */
    public function &getFeatures() {
        return $this->features;
    }

    /**
     * Set features
     * @param array $features
     */
    public function setFeatures($features) {
        $this->features = $features;
    }
}