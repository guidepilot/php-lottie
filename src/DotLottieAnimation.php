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
 * An object that represents a single lottie animation that has been extracted from a dotLottie file.
 *
 */
class DotLottieAnimation extends LottieAnimation {

    protected ?string $_id = null;

    /**
     * Create a mew DotLottieAnimation instance.
     *
     * @param string $id The unique id of the animation
     * @param string|null $content The raw content  of the animation (file) as string
     */
    public function __construct(string $id, ?string $content) {
        $this->_id = $id;

        parent::__construct($content);
    }

    /**
     * Get the ID of the animation as listed in the manifest.
     *
     * @return string|null
     */
    public function getId(): ?string {
        return $this->_id;
    }



}