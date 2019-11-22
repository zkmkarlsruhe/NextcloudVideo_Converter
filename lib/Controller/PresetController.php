<?php
namespace OCA\Video_Converter\Controller;

use OCP\IRequest;
use OCP\IConfig;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Controller;

class PresetController implements Controller {
	private $config;
	private $userId;

	/**
	* @NoAdminRequired
	*/
	public function __construct(string $appName, IRequest $request, IConfig $config, string $userId) {
		parent::__construct($appName, $request);
		$this->config = $config;
		$this->userId = $userId;
	}

	/**
	* @NoAdminRequired
	*/
	public function index() {

	}

	/**
	* @NoAdminRequired
	*/
	public function show() {

	}

	/**
	* @NoAdminRequired
	*/
	public function create() {

	}

	/**
	* @NoAdminRequired
	*/
	public function update() {

	}

	/**
	* @NoAdminRequired
	*/
	public function destroy() {

	}
}
