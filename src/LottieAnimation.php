<?php
/**
 * Copyright (c) GuidePilot. (https://guidepilot.de)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) GuidePilot. (https://guidepilot.de)
 * @link          https://guidepilot.de GuidePilot
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace GuidePilot\PhpLottie;

/**
 * An object that represents a simple lottie animation.
 *
 */
class LottieAnimation {

    protected ?array $_content = null;

    /**
     * Create a mew LottieAnimation instance.
     *
     * @param string|null $content The raw content  of the animation (file) as string
     */
    public function __construct(?string $content) {
        if ($content) {
            $this->loadContent($content);
        }
    }

    /**
     * Get the parsed content of the animation as associative array.
     * @return array|null
     */
    public function getContent(): ?array {
        return $this->_content;
    }

    protected function loadContent(string $jsonData) {
        $this->_content = json_decode($jsonData, true);
    }

    /**
     * Determine if the content could be loaded.
     *
     * @return bool
     */
    public function isContentLoaded(): bool {
        return !empty($this->_content);
    }

    /**
     * Get the width of the animation.
     *
     * @return int|null
     */
    public function getWidth(): ?int {
        return $this->_content['w'] ?? null;
    }

    /**
     * Get the height of the animation.
     *
     * @return int|null
     */
    public function getHeight(): ?int {
        return $this->_content['h'] ?? null;
    }

    /**
     * Get the framerate of the animation.
     *
     * @return int|null
     */
    public function getFrameRate(): ?int {
        return $this->_content['fr'] ?? null;
    }

    /**
     * Get the in point (frame index) of the animation.
     *
     * @return int|null
     */
    public function getInPoint(): ?int {
        return $this->_content['ip'] ?? null;
    }

    /**
     * Get the out point (frame index) of the animation.
     *
     * @return int|null
     */
    public function getOutPoint(): ?int {
        return $this->_content['op'] ?? null;
    }

    /**
     * Get the calculated duration of the animation in seconds at speed 1x based on framerate, in and out.
     *
     * @return int|null
     */
    public function getDuration(): ?int {
        if (is_null($inPoint = $this->getInPoint())) {
            return null;
        }

        if (is_null($outPoint = $this->getOutPoint())) {
            return null;
        }

        if (is_null($frameRate = $this->getFrameRate())) {
            return null;
        }

        return ceil(abs($outPoint-$inPoint)/$frameRate);
    }
}