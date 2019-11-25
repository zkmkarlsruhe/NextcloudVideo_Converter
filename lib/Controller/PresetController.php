<?php
namespace OCA\Video_Converter\Controller;

use OCP\IRequest;
use OCP\IConfig;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Controller;

use OCA\Video_Converter\Services\PresetStorageService;

class PresetController extends Controller {
	private $storage;
	private $userId;

	/**
	* @NoAdminRequired
	*/
	public function __construct(string $appName, IRequest $request, PresetStorageService $storage, string $userId) {
		parent::__construct($appName, $request);
		$this->storage = $storage;
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
	public function get($id) {

	}

	/**
	* @NoAdminRequired
	*/
	public function create() {

	}

	/**
	* @NoAdminRequired
	*/
	public function update($id) {
		
	}

	/**
	* @NoAdminRequired
	*/
	public function remove($id) {

	}
}
