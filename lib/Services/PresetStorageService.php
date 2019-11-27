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
			$this->initPresets();
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

				$this->resetPresets();
			}
		}
	}

	public function initPresets() {

	}

	public function getPresets(int $presetId) {
		if (!array_key_exists($presetId, $this->presets)) {
			return null;
		}

		return $this->presets[$presetId];
	}

	public function setPreset(int $presetId, string $value) {

	}

	public function appendPreset(string $value): int {

	}

	public function removePreset(int $presetId) {
		if (!array_key_exists($presetId, $this->presets)) {
			return null;
		}

		$val = $this->presets[$presetId];
		unset($this->presets[$presetId]);
		return $val;
	}

	public function resetPresets() {
		$this->initPresets();
	}

	private function getNextPresetId() {
		if ($this->presets == null || sizeof($this->presets) == 0) {
			return 0;
		}

		$presetIds = array_keys($this->presets);
		sort($presetIds);

		for ($i = 0; $i < sizeof($presetId); $i++) {
			$elem = $presetIds[$i];

			if ($elem != $i) {
				return $i;
			}
		}

		return 0;
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