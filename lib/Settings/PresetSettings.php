<?php
namespace OCA\Video_Converter\Settings;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\IConfig;
use OCP\Settings\ISettings;

class PresetSettings implements ISettings {
	/** @var IConfig */
	private $config;
	/** @var string */
	private $appName;
	/** @var string */
	private $userId;

	/**
	 * @param IConfig $config AppConfig-Instance
	 * @param string $appName
	 * @param string $userId Id of the user requesting the page.
	 */
	public function __construct(IConfig $config, string $appName, string $userId) {
		$this->$config = $config;
		$this->appName = $appName;
		$this->userId = $userId;
	}

	/**
	 * Returns the Template for the Settings-Page.
	 * 
	 * @return TemplateResponse
	 */
	public function getForm() {
		return new TemplateResponse($this->appName, 'settings');
	}

	/**
	 * Returns the (internal) name of the used section.
	 * 
	 * @return string
	 */
	public function getSection() {
		return $this->appName;
	}

	/**
	 * Place at the bottom of the settings tab.
	 * 
	 * @return int
	 */
	public function getPriority() {
		return 100;
	}
}