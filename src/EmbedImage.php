<?php


namespace Livaco\EasyDiscordWebhook;


class EmbedImage extends EmbedVideo {
	private $proxy_url;

	public function __construct(string $url = '', string $proxy_url = '', int $height = 0, int $width = 0){
		parent::__construct($url, $height, $width);
		$this->proxy_url = $proxy_url;
	}

	public function jsonSerialize(){
		$data = parent::jsonSerialize();
		$data['proxy_url'] = $this->proxy_url;
		return array_filter($data);
	}
}