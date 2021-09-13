<?php

namespace GuidePilot\PhpLottie;

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