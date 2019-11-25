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

	public function init() {

	}

	public function get() {

	}

	public function set() {

	}

	public function remove() {

	}

	public function reset() {
		
	}

}