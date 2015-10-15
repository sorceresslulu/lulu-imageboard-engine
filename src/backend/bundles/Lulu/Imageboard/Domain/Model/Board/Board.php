<?php
namespace Lulu\Imageboard\Application\DoctrineApplication\Domain\Model\Board;

use Lulu\Imageboard\Domain\Entity\Board as BoardEntity;

class Board
{
    /**
     * Board Entity
     * @var BoardEntity
     */
    private $boardEntity;

    /**
     * Board Features
     * @var Features
     */
    private $features;

    /**
     * Board constructor.
     * @param BoardEntity $boardEntity
     * @param Features $features
     */
    public function __construct(BoardEntity $boardEntity, Features $features) {
        $this->boardEntity = $boardEntity;
        $this->features = $features;
    }

    /**
     * Returns board entity
     * @return BoardEntity
     */
    public function getBoardEntity() {
        return $this->boardEntity;
    }

    /**
     * Returns features
     * @return Features
     */
    public function getFeatures() {
        return $this->features;
    }
}