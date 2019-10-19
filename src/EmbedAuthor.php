<?php


namespace Livaco\EasyDiscordWebhook;


class EmbedAuthor extends EmbedProvider {
	private $icon_url;
	private $proxy_icon_url;

	public function __construct(string $name = '', string $url = '', string $icon_url = '', string $proxy_icon_url = ''){
		parent::__construct($name, $url);
		$this->icon_url = $icon_url;
		$this->proxy_icon_url = $proxy_icon_url;
	}

	public function jsonSerialize(){
		$data = parent::jsonSerialize();
		$data['icon_url'] = $this->icon_url;
		$data['proxy_icon_url'] = $this->proxy_icon_url;
		return array_filter($data);
	}
}