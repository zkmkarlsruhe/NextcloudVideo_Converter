<?php
namespace OCA\Video_Converter\Services;

use OCP\IConfig;

class PresetStorageService {
	private $appName;
	private $config;
	
	public function __construct(string $appName, IConfig $config) {
		$this->appName = $appName;
		$this->config = $config;
	}

	public function init(string $userId) {

	}

	public function get(string $userId, int $presetId) {

	}

	public function set(string $userId, int $presetId, string $value) {

	}

	public function append(string $userId, string $value): int {

	}

	public function remove(string $userId, int $presetId) {

	}

	public function reset(string $userId) {
		
	}

	private function initialized(string $userId): bool {
		if ($this->config->getUserValue($userId, $this->appName, 'config') == '') {
			return false;
		}

		return true;
	}
}