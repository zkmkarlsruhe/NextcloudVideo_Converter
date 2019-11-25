<?php
namespace OCA\Video_Converter\Services;

use OCP\IConfig;
use OCP\ILogger;

class PresetStorageService {
	private $appName;
	private $config;
	private $logger;
	private $presets;

	private const configKey = 'config';

	public function __construct(string $appName, IConfig $config, ILogger $logger, string $userId) {
		$this->appName = $appName;
		$this->config = $config;
		$this->logger = $logger;
		$this->userId = $userId;


		if (!configExists()) {
			init();
		} else {
			$presetJSON = $this->config->getUserValue($this->userId, $this->appName, $this->configKey);
			$error = $this->loadPresets($presetJSON);

			if ($error != JSON_ERROR_NONE) {
				$msg = json_last_error_msg();

				$this->logger->error('Invalid JSON read from config', array(
					'appName' => $this->appName,
					'userId' => $this->userId,
					'JSON' => $presetJSON
				));

				$this->reset();
			}
		}
	}

	public function init() {

	}

	public function get(int $presetId) {

	}

	public function set(int $presetId, string $value) {

	}

	public function append(string $value): int {

	}

	public function remove(int $presetId) {

	}

	public function reset() {
		$this->init();
	}

	/*
	 * @returns JSON_ERROR-Code or 0 if successful
	 */
	private function loadPresets(string $JSON): int {
		$presetsArr = json_decode($JSON, true);

		if ($presetsArr == null) {
			return json_last_error();
		}

		//TODO: Add Present-Element and assemble a list of them
	}

	private function configExists(): bool {
		if ($this->config->getUserValue($this->$userId, $this->appName, $this->configKey) == '') {
			return false;
		}

		return true;
	}
}