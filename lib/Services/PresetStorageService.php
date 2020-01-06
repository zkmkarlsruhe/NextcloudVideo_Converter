<?php
namespace OCA\Video_Converter\Services;

use OCP\ILogger;

use OCA\Video_Converter\Services\UserStorageService;

/** Handles the storage, deletion and updating of Presets. */
class PresetStorageService {
	/** @var string */
	private $appName;
	/** @var ILogger $logger Logger to report Warnings */
	private $logger;
	/** @var UserStorageService $storage Storage-Backend for the Presets */
	protected $storage;
	/** @var Array $presetIds Cached list of Preset-Ids */
	protected $presetIds;

	/**
	 * @param string $appName
	 * @param ILogger $logger
	 * @param UserStorageService $storage
	 * @param string $userId User who made the Preset-Request.
	 */
	public function __construct(string $appName, ILogger $logger, UserStorageService $storage, string $userId) {
		$this->appName = $appName;
		$this->logger = $logger;
		$this->storage = $storage;
		$this->userId = $userId;

		/** @todo Rewrite with new storage-backend */
		$this->queryIds();
		$this->presetIds = $this->storage->getPresetIds();
		if (sizeof($numPresets) == 0) {
			$this->initPresets();
		}
	}

	/**
	 * Inits the Presets aka. loads the default Presets, 
	 * if the user has no Presets currently.
	 * 
	 * @throws LogicException if something went wrong while 
	 * 		loading the (static) Presets.
	 */
	public function initPresets() {
		/** @todo load defaults */
	}

	/**
	 * Returns the Preset with the specified $id, or null if there is no such Element.
	 * 
	 * @param int $id Id of the Preset to fetch.
	 * @throws OutOfBoundsException if an int smaller than 0 was given.
	 * @return Preset|null 
	 */
	public function getPreset(int $id) {
		$this->validId($id);
		if (!$this->idExists($id)) {
			return null;
		}

		/** @todo Parse this as a Preset once the class is done */
		return $this->storage->getFileContent($id);
	}

	/**
	 * Returns an Array of all Preset-Ids.
	 * 
	 * @return Array 
	 */
	public function listPresets(): array {
		return $this->presetIds;
	}

	/** 
	 * Updates the Preset with a new value. 
	 * The id must already exist.
	 * 
	 * @param int $id Id of the Preset to update.
	 * @param string $value JSONified Preset which will replace the old one.
	 * @throws OutOfBoundsException if the id does not exist or is not valid.
	 * @throws InvalidArgumentException if the $value is not a valid Preset.
	 */
	public function setPreset(int $id, string $value) {
		$this->validId();
		if (!$this->idExists($id)) {
			throw new OutOfBoundsException("Preset with this id doesn't exist");
		}
		/** @todo Implement */
	}

	/**
	 * Appends a new Preset to the list.
	 * 
	 * @param string $value JSONified Preset to append.
	 * @throws InvalidArgumentException if the $value is not a valid Preset.
	 * @return int Id of the new Preset, or -1 if something went wrong.
	 */
	public function appendPreset(string $value): int {
		/** @todo Implement */
	}

	/** 
	 * Removes an existing Preset from the list.
	 * 
	 * @param int $id Id of Preset to remove.
	 * @throws OutOfBoundsException if the id does not exist or is not valid.
	 */
	public function removePreset(int $id) {
		$this->validId($id);
		if (!$this->idExists($id)) {
			throw new OutOfBoundsException("Preset with this id doesn't exist");
		}

		$this->storage->deleteFile($id);
		/** @todo Implement a more efficient way that does not iterate over the whole list. */
		$this->queryIds();
	}

	/**
	 * Resets the Presets to the default state.
	 * @throws LogicException if something went wrong while 
	 * 		loading the (static) Presets.
	 */
	public function resetPresets() {
		$this->initPresets();
	}

	/** 
	 * Asks the Storage-Backend for a copy of all existing ids.
	 * 
	 * @throws RuntimeException if something went wrong in the storage backend.
	 */
	protected function queryIds() {
		$this->presetIds = $this->storage->getPresetIds();
	}

	/**
	 * Checks if there is a Preset with this Id.
	 * 
	 * @param bool Result of this operation
	 */
	protected function idExists(int $id): bool {
		return in_array($id, $this->presetIds);
	}

	/**
	 * Checks if the id is valid(>= 0).
	 * 
	 * @throws OutOfBoundsException otherwise.
	 */
	protected function validId(int $id) {
		if ($id < 0) {
			throw new OutOfBoundsException("Ids have to be a positive Integer");
		}
	}

	/**
	 * Computes the next, free Preset Id.
	 * Designed to fill holes in the id-list over time.
	 * 
	 * @return int next free id
	 */
	protected function getNextPresetId(): int {
		if (sizeof($this->presetIds) == 0) {
			return 0;
		}

		$ids = $this->presetIds;
		sort($ids);

		for ($i = 0; $i < sizeof($ids); $i++) {
			$elem = $ids[$i];

			if ($elem != $i) {
				return $i;
			}
		}

		return 0;
	}

	/** 
	 * Parses a Preset from JSON and adds it to the Storage-Backend.
	 * 
	 * @param string $JSON Preset-Json to decode.
	 * @throws InvalidArgumentException if the $JSON is not a valid Preset or JSON.
	 * @return int JSON_ERROR-Code or 0 if successful
	 */
	protected function loadPreset(string $JSON): int {
		$presetsArr = json_decode($JSON, true);

		if ($presetsArr == null) {
			throw new InvalidArgumentException(\json_last_error_msg());
		}

		/** @todo Convert the array into a Preset */
	}
}