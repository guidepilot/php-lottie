<?php


use GuidePilot\PhpLottie\LottieAnimation;

require_once '../vendor/autoload.php';

$lottieAnimation = new LottieAnimation(file_get_contents('animation.json'));

echo "Size: {$lottieAnimation->getWidth()}x{$lottieAnimation->getHeight()}".PHP_EOL;
echo "FrameRate: {$lottieAnimation->getFrameRate()}".PHP_EOL;
echo "Duration: {$lottieAnimation->getDuration()} seconds".PHP_EOL;