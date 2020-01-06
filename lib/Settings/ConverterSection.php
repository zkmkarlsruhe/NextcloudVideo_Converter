<?php
namespace OCA\Video_Converter\Settings;

use OCP\IURLGenerator;
use OCP\Settings\IIconSection;

class ConverterSection implements IIconSection {
	/** @var string */
	private $appName;
	/** @var IURLGenerator */
	private $urlGenerator;

	/**
	 * @param string $appName
	 * @param IURLGenerator $urlGenerator URL-Generator to get the Icon-Path.
	 */
	public function __construct(string $appName, IURLGenerator $urlGenerator) {
		$this->appName = $appName;
		$this->urlGenerator = $urlGenerator;
	}

	/**
	 * Returns the (internal) name used for this section.
	 * 
	 * @return string
	 */
	public function getID() {
		return $this->appName;
	}

	/**
	 * Returns the displayed name of the SettingsSection.
	 * 
	 * @return string
	 */
	public function getName() {
		return 'Video Converter';
	}

	/** 
	 * Place this Section at the bottom of the list.
	 * 
	 * @return int
	 */
	public function getPriority() {
		return 100;
	}

	/**
	 * Returns the path to the Apps Icon.
	 * 
	 * @return string
	 */
	public function getIcon() {
		return $this->urlGenerator->imagePath($this->appName, 'convert_icon.svg');
	}
}
