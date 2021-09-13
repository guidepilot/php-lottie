# PHP Lottie

The PHP Lottie library allows to simply extract basic metatdata out of [Lottie](https://lottiefiles.com/) animation files and [dotLottie](https://dotlottie.io/) files, such as:
- width and height
- frame rate
- duration

## Installation

Installing with composer:

```
$ composer require guidepilot/php-lottie
```

## Usage

### Simple usage with lottie animation

```php
<?php
use GuidePilot\PhpLottie\LottieAnimation;

$lottieAnimation = new LottieAnimation(readfile('animation.json'));

echo "Size: {$lottieAnimation->getWidth()}x{$lottieAnimation->getHeight()}".PHP_EOL;
echo "FrameRate: {$lottieAnimation->getFrameRate()}".PHP_EOL;
echo "Duration: {$lottieAnimation->getDuration()} seconds".PHP_EOL;
```


### Usage with a dotLottie file

```php
<?php
use GuidePilot\PhpLottie\DotLottieFile;

$file = new DotLottieFile('animation.lottie');

foreach ($file->getAnimations() as $aAnimation) {
    echo "Animation Id: {$aAnimation->getId()}".PHP_EOL;
    echo "Size: {$aAnimation->getWidth()}x{$aAnimation->getHeight()}".PHP_EOL;
    echo "FrameRate: {$aAnimation->getFrameRate()}".PHP_EOL;
    echo "Duration: {$aAnimation->getDuration()} seconds".PHP_EOL;
}
```
