<?php


namespace Livaco\EasyDiscordWebhook;


use JsonSerializable;

/**
 * This class represents a rich embed footer.
 * Class EmbedFooter
 * @package Livaco\EasyDiscordWebhook
 */
class EmbedFooter implements JsonSerializable {
	private $text = '';
	private $icon_url;
	private $proxy_icon_url;

	/**
	 * EmbedFooter constructor.
	 * @param string $text The footer text.
	 * @param string $icon_url Icon for the footer.
	 * @param string $proxy_icon_url -
	 */
	public function __construct(string $text = '', string $icon_url = '', string $proxy_icon_url = ''){
		$this->text = $text;
		$this->icon_url = $icon_url;
		$this->proxy_icon_url = $proxy_icon_url;
	}

	/**
	 * Convert the object into an associative array.
	 * @return array
	 */
	public function jsonSerialize(){
		return array_filter([
			'text' => $this->text,
			'icon_url' => $this->icon_url,
			'proxy_icon_url' => $this->proxy_icon_url
		]);
	}
}