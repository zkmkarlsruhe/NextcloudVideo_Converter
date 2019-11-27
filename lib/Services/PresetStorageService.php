<?php
namespace OCA\Video_Converter\Services;

use OCP\ILogger;

use OCA\Video_Converter\Services\UserStorageService;


class PresetStorageService {
	private $appName;
	private $logger;
	private $storage;
	private $presetIds;
	private $presets;

	public function __construct(string $appName, ILogger $logger, UserStorageService $storage, string $userId) {
		$this->appName = $appName;
		$this->logger = $logger;
		$this->storage = $storage;
		$this->userId = $userId;

		//TODO: Rewrite with new storage-backend
		$this->presetIds = $this->storage->getPresetIds();
		if (sizeof($numPresets) == 0) {
			$this->initPresets();
		}
	}

	public function initPresets() {

	}

	public function getPresets(int $presetId) {
		if (!$this->idExists($presetId)) {
			return null;
		}

		return $this->presets[$presetId];
	}

	public function setPreset(int $presetId, string $value) {

	}

	public function appendPreset(string $value): int {

	}

	public function removePreset(int $presetId) {
		if (!$this->idExists($presetId)) {
			return null;
		}

		$val = $this->presets[$presetId];
		unset($this->presets[$presetId]);
		return $val;
	}

	public function resetPresets() {
		$this->initPresets();
	}

	private function idExists(int $id): bool {
		return array_key_exists($id, $this->preset);
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
}