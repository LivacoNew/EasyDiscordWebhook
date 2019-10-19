<?php

namespace Livaco\EasyDiscordWebhook;

use JsonSerializable;



/** Class for converting various color forms into a decimal integer.
 * Class Color
 * @package Livaco\EasyDiscordWebhook
 */
class Color implements JsonSerializable {
	private $r = 0;
	private $g = 0;
	private $b = 0;

	/**
	 * Color constructor.
	 * @param int $r Amount of red in the color, from 0 to 255.
	 * @param int $g Amount of green in the color, from 0 to 255.
	 * @param int $b Amount of blue in the color, from 0 to 255.
	 */
	public function __construct(int $r, int $g, int $b){
		$this->r = $r;
		$this->g = $g;
		$this->b = $b;
	}

	/**
	 * Generate a color object from a hex triplet or a hex short.
	 * @param string $code
	 * @return Color
	 */
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

	/**
	 * Generate a colour object from a decimal number.
	 * @param int $number
	 * @return Color
	 */
	public static function fromDecimal(int $number): Color{
		return new static($number & 0xFF0000, $number & 0x00FF00, $number & 0x0000FF);
	}

	/**
	 * Convert the object into an integer representation.
	 * @return int
	 */
	public function jsonSerialize(): int{
		return ($this->r << 16) + ($this->g << 8) + $this->b;
	}
}