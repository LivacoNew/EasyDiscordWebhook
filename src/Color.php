<?php


namespace Livaco\EasyDiscordWebhook;

use JsonSerializable;

class Color implements JsonSerializable {
	private $r = 0;
	private $g = 0;
	private $b = 0;

	public function __construct(int $r, int $g, int $b){
		$this->r = $r;
		$this->g = $g;
		$this->b = $b;
	}

	public static function fromHex(string $code): Color{
		$code = str_replace('#', '', $code);
		$colors = array_map('hexdec', str_split($code, intdiv(strlen($code), 3)));

		if (strlen($code) === 3){
			$colors = array_map(function($color){
				return $color + ($color * 16);
			}, $colors);
		}

		return new static(...$colors);
	}

	public static function fromDecimal(int $number): Color{
		return new static($number & 0xFF0000, $number & 0x00FF00, $number & 0x0000FF);
	}

	public function jsonSerialize(){
		return ($this->r << 16) + ($this->g << 8) + $this->b;
	}
}