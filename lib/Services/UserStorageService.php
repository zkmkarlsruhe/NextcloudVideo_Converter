<?php
namespace OCA\Video_Converter\Services;

use OCP\ILogger;
use OCP\Files\IAppData;
use OCP\Files\NotFoundException;
use OCP\Files\SimpleFS\ISimpleFile;
use OCP\Files\SimpleFS\ISimpleFolder;

//TODO: Catch RuntimeExceptions
//TODO: (Maybe) handle NotPermittedException. Shouldn't apply
class UserStorageService {
	private $appName;
	private $userId;
	private $userFolder;
	private $logger;

	private const extension = ".json";

	public function __construct(string $appName, IAppData $appData, ILogger $logger, string $userId) {
		$this->appName = $appName;
		$this->logger = $logger;
		$this->userId = $userId;

		$folder = null;
		try {
			$folder = $this->appData->getFolder($this->userId);
		} catch (NotFoundException $e) {
			$folder = $this->appData->newFolder($this->$userId);
		}

		$this->userFolder = $folder;
	}

	public function fileExists(int $presetId): bool {
		$filename = $this->addExtension($presetId);

		return $this->userFolder->fileExists($filename);
	}

	public function getFileContent(int $presetId) {
		$filename = $this->addExtension($presetId);

		if ($this->userFolder->fileExists($filename)) {
			$file = $this->userFolder->getFile($filename);
			return $file->getContent();
		}

		return null;
	}

	public function setFileContent(int $presetId, string $content) {
		$filename = $this->addExtension($presetId);

		$file = null;
		if (!$this->userFolder->fileExists($filename)) {
			$this->userFolder->newFile($filename);
		}

		$file = $this->userFolder->getFile($filename);

		$file->putContent($content);
	}

	public function deleteFile(int $presetId) {
		$filename = $this->addExtension($presetId);

		if ($this->userFolder->fileExists($filename)) {
			$file = $this->userFolder->getFile($filename);
			$file->delete();
		}
	}
	
	public function addExtension(int $id): string {
		$filename = $id . self::extension;
	}

	/*
	 * @Throws LengthException 
	 */
	public function removeExtension(string $filename) {
		$length = strlen($filename);
		$extensionLength = strlen(self::extension);

		if ($length <= $extensionLength) {
			throw new LengthException("String " . $filename . "has to be longer than Extension " . self::extension);
		}

		return substr($filename, 0, -$extensionLength);
	}
}