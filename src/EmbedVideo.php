<?php


namespace Livaco\EasyDiscordWebhook;


use JsonSerializable;

class EmbedVideo implements JsonSerializable {
	private $url;
	private $height;
	private $width;

	public function __construct(string $url = '', int $height = 0, int $width = 0){
		$this->url = $url;
		$this->height = $height;
		$this->width = $width;
	}

	public function jsonSerialize(){
		return array_filter([
			'url' => $this->url,
			'height' => $this->height,
			'width' => $this->width
		]);
	}
}