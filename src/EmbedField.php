<?php


namespace Livaco\EasyDiscordWebhook;


use JsonSerializable;

/**
 * This class represents a field for a rich embed.
 * Class EmbedField
 * @package Livaco\EasyDiscordWebhook
 */
class EmbedField implements JsonSerializable {
	private $name = '';
	private $value = '';
	private $inline;

	/**
	 * EmbedField constructor.
	 * @param string $name
	 * @param string $value
	 * @param bool $inline
	 */
	public function __construct(string $name = '', string $value = '', bool $inline = false){
		$this->name = $name;
		$this->value = $value;
		$this->inline = $inline;
	}

	/**
	 * Convert the object into an associative array.
	 * @return array
	 */
	public function jsonSerialize(): array{
		return array_filter([
			'name' => $this->name,
			'value' => $this->value,
			'inline' => $this->inline
		]);
	}
}