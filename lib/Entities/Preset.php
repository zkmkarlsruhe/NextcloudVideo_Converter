<?php
namespace OCA\Video_Converter\Entities;

class Preset implements JsonSerializable {
	protected $audioCodec;
	protected $bitrate;
	protected $audioChannels;

	protected $videoCodec;
	protected $framerate;
	protected $resolutionX;
	protected $resolutionY;

	protected $watermarkPath;
	protected $watermarkX;
	protected $watermarkY;
	protected $watermarkMode;

	protected $additionalArgs;

}