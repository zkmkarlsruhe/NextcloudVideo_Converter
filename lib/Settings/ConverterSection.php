<?php
namespace OCA\Video_Converter\Settings;

use OCP\IURLGenerator;
use OCP\Settings\IIconSection;

class ConverterSection implements IIconSection {
    private $appName;
    private $url;

    public function __construct($appName, IURLGenerator $url) {
        $this->appName = $appName;
        $this->url = $url;
    }

    public function getID() {
        return $this->appName;
    }

    public function getName() {
        return 'Video Converter';
    }

    public function getPriority() {
        return 100;
    }

    public function getIcon() {
        return $this->url->imagePath($this->appName, 'convert_icon.svg');
    }
}
