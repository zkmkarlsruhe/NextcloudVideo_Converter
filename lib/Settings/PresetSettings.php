<?php
namespace OCA\Video_Converter\Settings;

use OCP\IConfig;
use OCP\Settings\ISettings;

class PresetSettings implements ISettings {
    private $config;
    private $userId;

    public function __construct(IConfig $config, $userId)
    {
        $this->$config = $config;
        $this->userId = $userId;
    }

    public function getSection() {
        return 'additional';
    }

    /**
     * Place at the bottom of the settings tab.
     * @return int
     */
    public function getPriority() {
        return 100;
    }
}