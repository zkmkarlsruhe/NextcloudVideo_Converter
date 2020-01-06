<?php
namespace OCA\Video_Converter\Entities;

/**
 * Preset for a Video-Conversion
 */
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
	/** @var int */
	protected $bitrate;
	/** @var int */
	protected $audioChannels;

	/** @var string */
	protected $videoCodec;
	/** @var float|string */
	protected $framerate;
	/** @var int|string */
	protected $resolutionX;
	/** @var int|string */
	protected $resolutionY;

	/** @var string */
	protected $watermarkPath;
	/** @var int|string */
	protected $watermarkX;
	/** @var int|string */
	protected $watermarkY;
	/** @var string */
	protected $watermarkMode;

	/** @var Array */
	protected $additionalArgs;

}