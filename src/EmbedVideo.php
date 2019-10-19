<?php


namespace Livaco\EasyDiscordWebhook;


use JsonSerializable;

/**
 * Represents an embedded video.
 * Class EmbedVideo
 * @package Livaco\EasyDiscordWebhook
 */
class EmbedVideo implements JsonSerializable {
	private $url;
	private $height;
	private $width;

	/**
	 * EmbedVideo constructor.
	 * @param string $url Video URL
	 * @param int $height Height of the video.
	 * @param int $width Width of the video.
	 */
	public function __construct(string $url = '', int $height = 0, int $width = 0){
		$this->url = $url;
		$this->height = $height;
		$this->width = $width;
	}

	/**
	 * Convert the object into an associative array.
	 * @return array
	 */
	public function jsonSerialize(){
		return array_filter([
			'url' => $this->url,
			'height' => $this->height,
			'width' => $this->width
		]);
	}
}