<?php


namespace Livaco\EasyDiscordWebhook;

/**
 * This class represents the author field for a rich embed.
 * Class EmbedAuthor
 * @package Livaco\EasyDiscordWebhook
 */
class EmbedAuthor extends EmbedProvider {
	private $icon_url;
	private $proxy_icon_url;

	/**
	 * EmbedAuthor constructor.
	 * @param string $name Author's name.
	 * @param string $url Link for the author's name.
	 * @param string $icon_url Author's icon.
	 * @param string $proxy_icon_url -
	 */
	public function __construct(string $name = '', string $url = '', string $icon_url = '', string $proxy_icon_url = ''){
		parent::__construct($name, $url);
		$this->icon_url = $icon_url;
		$this->proxy_icon_url = $proxy_icon_url;
	}

	/**
	 * Convert the object into an associative array.
	 * @return array
	 */
	public function jsonSerialize(): array{
		$data = parent::jsonSerialize();
		$data['icon_url'] = $this->icon_url;
		$data['proxy_icon_url'] = $this->proxy_icon_url;
		return array_filter($data);
	}
}