<?php


namespace Livaco\EasyDiscordWebhook;


use JsonSerializable;

class EmbedField implements JsonSerializable {
	private $name = '';
	private $value = '';
	private $inline;

	public function __construct(string $name = '', string $value = '', bool $inline = false){
		$this->name = $name;
		$this->value = $value;
		$this->inline = $inline;
	}

	public function jsonSerialize(){
		return array_filter([
			'name' => $this->name,
			'value' => $this->value,
			'inline' => $this->inline
		]);
	}
}