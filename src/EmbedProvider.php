<?php


namespace Livaco\EasyDiscordWebhook;

/**
 * Represents an internal embed provider.
 * Class EmbedProvider
 * @package Livaco\EasyDiscordWebhook
 */
class EmbedProvider {
	private $name;
	private $url;

	/**
	 * EmbedProvider constructor.
	 * @param string $name Name of the provider.
	 * @param string $url Provider URL.
	 */
	public function __construct(string $name = '', string $url = ''){
		$this->name = $name;
		$this->url = $url;
	}

	/**
	 * Convert the object into an associative array.
	 * @return array
	 */
	public function jsonSerialize(){
		return array_filter([
			'name' => $this->name,
			'url' => $this->url
		]);
	}
}