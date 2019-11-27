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
	private $appData;
	private $logger;

	public function __construct(string $appName, IAppData $appData, ILogger $logger, string $userId) {
		$this->appName = $appName;
		$this->appData = $appData;
		$this->logger = $logger;
		$this->userId = $userId;

		$folder = null;
		try {
			$folder = $this->appData->getFolder($this->userId);
		} catch (NotFoundException $e) {
			$folder = $this->appData->newFolder($this->$userId);
		}
	}
}