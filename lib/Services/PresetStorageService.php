<?php
namespace OCA\Video_Converter\Services;

use OCP\IConfig;

class PresetStorageService {
	private $appName;
	private $config;

	public function __construct(string $appName, IConfig $config, string $userId) {
		$this->appName = $appName;
		$this->config = $config;
		$this->userId = $userId;
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
		
	}

	private function configExists(): bool {
		if ($this->config->getUserValue($this->$userId, $this->appName, 'config') == '') {
			return false;
		}

		return true;
	}
}