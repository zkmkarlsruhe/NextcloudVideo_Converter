<?php
namespace OCA\Video_Converter\Services;

use OCP\ILogger;

use OCA\Video_Converter\Services\UserStorageService;


class PresetStorageService {
	private $appName;
	private $logger;
	private $storage;
	private $presetIds;

	public function __construct(string $appName, ILogger $logger, UserStorageService $storage, string $userId) {
		$this->appName = $appName;
		$this->logger = $logger;
		$this->storage = $storage;
		$this->userId = $userId;

		//TODO: Rewrite with new storage-backend
		$this->queryIds();
		$this->presetIds = $this->storage->getPresetIds();
		if (sizeof($numPresets) == 0) {
			$this->initPresets();
		}
	}

	public function initPresets() {

	}

	public function getPresets(int $id) {
		if (!$this->idExists($id)) {
			return null;
		}

		return $this->storage->getFileContent($id);
	}

	public function setPreset(int $id, string $value) {

	}

	public function appendPreset(string $value): int {

	}

	public function removePreset(int $id) {
		if (!$this->idExists($id)) {
			return null;
		}

		$val = $this->storage->getFileContent($id);
		$this->storage->deleteFile($id);
		$this->queryIds();
		return $val;
	}

	public function resetPresets() {
		$this->initPresets();
	}

	private function queryIds() {
		$this->presetIds = $this->storage->getPresetIds();
	}

	private function idExists(int $id): bool {
		return array_key_exists($id, $this->preset);
	}

	private function getNextPresetId() {
		if ($this->presets == null || sizeof($this->presets) == 0) {
			return 0;
		}

		$ids = array_keys($this->presets);
		sort($ids);

		for ($i = 0; $i < sizeof($ids); $i++) {
			$elem = ids[$i];

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