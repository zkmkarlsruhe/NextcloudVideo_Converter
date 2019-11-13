<?php
namespace OCA\Video_Converter\Settings;

use OCP\IConfig;
use OCP\Settings\ISettings;

class PresetSettings implements ISettings {
    private $config;
    private $appName;
    private $userId;

    public function __construct(IConfig $config, $appName, $userId)
    {
        $this->$config = $config;
        $this->appName = $appName;
        $this->userId = $userId;
    }

    /**
     * @return TemplateResponse
     */
    public function getForm() {
        return new TemplateResponse($this->appName, 'settings');
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