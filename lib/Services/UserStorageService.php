<?php
namespace OCA\Video_Converter\Services;

class UserStorageService {
	private $appName;
	private $userId;

	public function __construct(string $appName, string $userId) {
		$this->appName = $appName;
		$this->userId = $userId;
	}
}