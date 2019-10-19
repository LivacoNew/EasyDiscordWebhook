<?php


namespace Livaco\EasyDiscordWebhook;


class EmbedProvider {
	private $name;
	private $url;

	public function __construct(string $name = '', string $url = ''){
		$this->name = $name;
		$this->url = $url;
	}

	public function jsonSerialize(){
		return array_filter([
			'name' => $this->name,
			'url' => $this->url
		]);
	}
}