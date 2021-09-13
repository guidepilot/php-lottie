<?php
namespace GuidePilot\PhpLottie;

use GuidePilot\PhpLottie\Exceptions\LottieFileInvalidException;
use GuidePilot\PhpLottie\Exceptions\UnableToReadFileException;
use ZipArchive;

class DotLottieFile {

    protected string $_file;

    protected ?ZipArchive $_zip = null;

    private ?array $_manifestData = null;

    /**
     * Create a mew DotLottieFile instance
     *
     * @param string $file The file path of the dotLottie file.
     *
     * @throws UnableToReadFileException
     * @throws LottieFileInvalidException
     */
    public function __construct(string $file) {
        $this->_file = $file;

        if (!$this->load()) {
            throw new UnableToReadFileException();
        }

        if (!$this->validate()) {
            throw new LottieFileInvalidException();
        }
    }

    protected function load(): bool {
        $zip = new ZipArchive();
        if ($zip->open($this->_file, ZipArchive::CREATE) !== true) {
            return false;
        }

        $this->_zip = $zip;
        return true;
    }

    /**
     * Gets the content of the manifest as associative array.
     *
     * @return array|null
     */
    public function getManifestData(): ?array {
        if (!$this->_manifestData) {
            if ($rawManifest = $this->_zip->getFromName('manifest.json')) {
                $this->_manifestData = json_decode($rawManifest, true);
            }
        }

        return $this->_manifestData;
    }

    /**
     * Determine if the loaded file is a valid dotLottie file.
     *
     * @return bool
     */
    public function validate(): bool {
        if (!$manifestData = $this->getManifestData()) {
            return false;
        }

        $requiredManifestKeys = [
          'version',
          'animations'
        ];

        foreach ($requiredManifestKeys as $aRequiredManifestKey) {
            if (!isset($manifestData[$aRequiredManifestKey])) {
                return false;
            }
        }

        return true;
    }

    /**
     * Gets an array of all animations within the dotLottie file.
     *
     * @return DotLottieAnimation[]
     * @throws LottieFileInvalidException
     */
    public function getAnimations(): array {
        $manifestData = $this->getManifestData();
        if (!isset($manifestData['animations']) || !is_array($manifestData['animations'])) {
            return [];
        }

        $animations = [];
        foreach ($manifestData['animations'] as $aRawAnimation) {

            if (!$animationId = $aRawAnimation['id']) {
                throw new LottieFileInvalidException("No animation id found in manifest.");
            }

            if (!$rawAnimation = $this->_zip->getFromName("animations/{$animationId}.json")) {
                throw new LottieFileInvalidException("Animation file for {$animationId} not found.");
            }

            $animations[] = new DotLottieAnimation($animationId, $rawAnimation);;
        }

        return $animations;
    }

}