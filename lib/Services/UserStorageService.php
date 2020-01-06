<?php
namespace OCA\Video_Converter\Services;

use OCP\ILogger;
use OCP\Files\IAppData;
use OCP\Files\NotFoundException;
use OCP\Files\SimpleFS\ISimpleFile;
use OCP\Files\SimpleFS\ISimpleFolder;

/** @todo Catch RuntimeExceptions */
/** @todo (Maybe) handle NotPermittedException. Shouldn't apply */

/** Stores the Presets in the SimpleFS for the App */
class UserStorageService {

	/** @var string */
	protected $appName;
	/** @var ISimpleFolder */
	protected $userFolder;
	/** @var ILogger */
	protected $logger;

	/** @var string */
	protected const extension = ".json";


	/**
	 * @param string $appName
	 * @param IAppData $appData Instance that let's us access ous SimpleFS.
	 * @param ILogger $logger Logger for writing out critical failures.
	 * @param string $userId User that made the request.
	 */
	public function __construct(string $appName, IAppData $appData, ILogger $logger, string $userId) {
		$this->appName = $appName;
		$this->logger = $logger;

		$folder = null;
		try {
			$folder = $this->appData->getFolder($userId);
		} catch (NotFoundException $e) {
			$folder = $this->appData->newFolder($userId);
		}

		$this->userFolder = $folder;
	}

	/** 
	 * Checks if a Preset with the $presetId exists for the user
	 * 
	 * @param int $presetId Id of the Preset to check
	 * @return bool Result of this check.
	 */
	public function fileExists(int $presetId): bool {
		$filename = $this->addExtension($presetId);

		return $this->userFolder->fileExists($filename);
	}

	/**
	 * Returns the content of the Preset.
	 * 
	 * @param int $presetId Id of the Preset to print.
	 * @throws OutOfBoundsException if no file with this id exists.
	 * @return string File-Content.
	 */
	public function getFileContent(int $presetId) {
		$filename = $this->addExtension($presetId);

		if ($this->userFolder->fileExists($filename)) {
			$file = $this->userFolder->getFile($filename);
			return $file->getContent();
		}

		throw new OutOfBoundsException("There is no Preset with this id");
	}

	/**
	 * Sets the File-Content to $content.
	 * The file is created if it doesn't already exist.
	 * 
	 * @param int $presetId Id of the Preset to set
	 * @param string $content Content that will be written to the file.
	 * 		We trust the middleware that this string is valid.
	 */
	public function setFileContent(int $presetId, string $content) {
		$filename = $this->addExtension($presetId);

		$file = null;
		if (!$this->userFolder->fileExists($filename)) {
			$this->userFolder->newFile($filename);
		}

		$file = $this->userFolder->getFile($filename);

		$file->putContent($content);
	}

	/** 
	 * Deletes the File belonging to the Preset.
	 * 
	 * @param int $presetId Id of the Preset to delete.
	 * @throws OutOfBoundsException if no file with this id exists.
	 */
	public function deleteFile(int $presetId) {
		$filename = $this->addExtension($presetId);

		if (!$this->userFolder->fileExists($filename)) {
			throw new OutOfBoundsException("There is no Preset with this id");
		}
		
		$file = $this->userFolder->getFile($filename);
		$file->delete();
	}
	
	/**
	 * Appends the used extension to the id.
	 * 
	 * @param int $presetId Id to append on.
	 * @return string filename with appended extension.
	 */
	public function addExtension(int $presetId): string {
		$filename = $presetId . self::extension;

		return $filename;
	}

	/** 
	 * Removes the extension from the filename(to get the id back).
	 * 
	 * @param string $filename Filename to remove the extension from.
	 * @throws LengthException if the specfied $filename is too short.
	 * @return string $flename without the extension.
	 */
	public function removeExtension(string $filename): string {
		$length = strlen($filename);
		$extensionLength = strlen(self::extension);

		if ($length <= $extensionLength) {
			throw new LengthException("String ${filename} has to be longer than Extension " . self::extension);
		}

		return substr($filename, 0, -$extensionLength);
	}

	/**
	 * Builds a list of the Preset-Ids.
	 * 
	 * @return array Array of (int) Preset-Ids.
	 */
	public function getPresetIds(): array {
		$files = $this->userFolder->getDirectoryListing();

		$ids = [];
		foreach ($files as $filename) {
			try {
				$id = (int)$this->removeExtension($filename);

				if (!$this->isInteger($id)) {
					throw new InvalidArgumentException('Non-ID file in appData-folder');
				}

				array_push($ids, (int)$id);
			} catch (LengthException $e) {
				$this->logger->logException($e, [
					'app' => $this->appName,
					'message' => 'Invalid filename for preset given'
				]);
			} catch (InvalidArgumentException $e) {
				$this->logger->logException($e, ['app' => $this->appName]);
			}
		}

		return $ids;
	}

	/**
	 * Checks if the string is a valid integer in the php integer range
	 * (which is surprisingly hard in php)
	 * 
	 * 
	 * @param string $number Stringified number to check. 
	 * @return bool true if it is a valid int > 0, < max int
	 */
	public function isInteger(string $number): bool {
		$onlyDigit = ctype_digit($number);
		if (!$onlyDigit) {
			return false;
		}

		$id = (int)$number;
		return ($id < PHP_INT_MAX);
	}
}