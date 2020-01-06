<?php
namespace OCA\Video_Converter\Controller;

use OCP\IRequest;
use OCP\IConfig;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Controller;

use OCA\Video_Converter\Services\PresetStorageService;

/**
 * JSON-API to interact with the Presets
 */
class PresetController extends Controller {
	/** @var PresetStorageService $storage Service that handles all the Presets. */
	private $storage;

	/**
	 * @NoAdminRequired
	 * 
	 * @param string $appName
	 * @param PresetStorageService $storage Preset-Controller
	 */
	public function __construct(string $appName, IRequest $request, PresetStorageService $storage) {
		parent::__construct($appName, $request);
		$this->storage = $storage;
	}

	/**
	 * List the Presets for the current user.
	 * 
	 * @NoAdminRequired
	 * @return JSONResponse
	 */
	public function index() {

	}

	/**
	 * Returns the Preset with the requested $id, or an error if there is no such Preset.
	 * 
	 * @NoAdminRequired
	 * @param int $id Id of the requested Preset.
	 * @return JSONResponse
	 */
	public function get(int $id) {

	}

	/**
	 * Creates the requested preset, if valid and returns the id.
	 * Otherwise a error is given.
	 * 
	 * @NoAdminRequired
	 * @return JSONResponse
	 */
	public function create() {

	}

	/**
	 * Updates the Preset with the $id to the newly given Preset, if valid.
	 * Otherwise an error is returned.
	 * 
	 * @NoAdminRequired
	 * @param int $id Id of the requested that has to be changed.
	 * @return JSONResponse
	 */
	public function update(int $id) {
		
	}

	/**
	 * Deletes the requested Preset from the Database.
	 * If there is no such Preset an error is returned.
	 * 
	 * @NoAdminRequired
	 * @param int $id Id of the Preset to be deleted.
	 * @return JSONResponse
	 */
	public function remove($id) {

	}
}
