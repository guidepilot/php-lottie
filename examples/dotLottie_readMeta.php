<?php

use GuidePilot\PhpLottie\DotLottieFile;

require_once '../vendor/autoload.php';

$file = new DotLottieFile('animation.lottie');

foreach ($file->getAnimations() as $aAnimation) {
    echo "Animation Id: {$aAnimation->getId()}".PHP_EOL;
    echo "Size: {$aAnimation->getWidth()}x{$aAnimation->getHeight()}".PHP_EOL;
    echo "FrameRate: {$aAnimation->getFrameRate()}".PHP_EOL;
    echo "Duration: {$aAnimation->getDuration()} seconds".PHP_EOL;
}


