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
}