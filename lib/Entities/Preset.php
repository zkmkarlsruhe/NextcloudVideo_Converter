<?php
namespace OCA\Video_Converter\Entities;

class Preset implements JsonSerializable {
	/** 
	 * All properties with either a primitive number or a string 
	 * follow the following format:
	 * In case of primitive number: <absolute value>
	 * In case of string: "<primitive number>x" The primitive number 
	 * here is a forfactor, designed for dynamic downscaling etc. related
	 * to editing batches of files in the same way.
	 */
	/** @var string */
	protected $audioCodec;
	/** @var integer */
	protected $bitrate;
	/** @var integer */
	protected $audioChannels;

	/** @var string */
	protected $videoCodec;
	/** @var float|string */
	protected $framerate;
	/** @var integer|string */
	protected $resolutionX;
	/** @var integer|string */
	protected $resolutionY;

	/** @var string */
	protected $watermarkPath;
	/** @var integer|string */
	protected $watermarkX;
	/** @var integer|string */
	protected $watermarkY;
	/** @var string */
	protected $watermarkMode;

	/** @var Array */
	protected $additionalArgs;

}