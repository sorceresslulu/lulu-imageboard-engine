<?php
namespace Lulu\Imageboard\Service\Post\Attachment\Upload\Detector;

use Lulu\Imageboard\Domain\Entity\Post;
use Lulu\Imageboard\Service\Post\Attachment\Upload\Detector\Detectors\ImageDetector;

class DetectorFactory
{
    const DETECTOR_IMAGE = 'image';
    const DETECTOR_WEBM = 'webm';

    /**
     * Post
     * @var Post
     */
    private $post;

    /**
     * Configuration
     * @var array
     */
    private $configuration;

    /**
     * DetectorFactory constructor.
     * @param Post $post
     * @param array $configuration
     */
    public function __construct(Post $post, array $configuration) {
        $this->post = $post;
        $this->configuration = $configuration;
    }

    /**
     * Create and returns detector by string code
     * @param $detectorStringCode
     * @return ImageDetector
     * @throws \Exception
     */
    public function createDetectorFromStringCode($detectorStringCode) {
        switch($detectorStringCode) {
            default:
                throw new \Exception(sprintf('Unknown detector with code `%s`', $detectorStringCode));

            case self::DETECTOR_IMAGE:
                return $this->createImageDetector();
        }
    }

    /**
     * Returns image detector
     * @return ImageDetector
     */
    protected function createImageDetector() {
        $detectorConfiguration = $this->configuration['image'];

        return new ImageDetector($detectorConfiguration['mime']);
    }
}