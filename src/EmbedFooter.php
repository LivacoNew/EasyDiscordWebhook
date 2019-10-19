<?php


namespace Livaco\EasyDiscordWebhook;


use JsonSerializable;

class EmbedFooter implements JsonSerializable {
	private $text = '';
	private $icon_url;
	private $proxy_icon_url;

	public function __construct(string $text = '', string $icon_url = '', string $proxy_icon_url = ''){
		$this->text = $text;
		$this->icon_url = $icon_url;
		$this->proxy_icon_url = $proxy_icon_url;
	}

	public function jsonSerialize(){
		return array_filter([
			'text' => $this->text,
			'icon_url' => $this->icon_url,
			'proxy_icon_url' => $this->proxy_icon_url
		]);
	}
}