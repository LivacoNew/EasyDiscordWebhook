<?php


namespace Livaco\EasyDiscordWebhook;

/**
 * This class represents images within the rich embed structure (thumbnails and images)
 * Class EmbedImage
 * @package Livaco\EasyDiscordWebhook
 */
class EmbedImage extends EmbedVideo {
	private $proxy_url;

	/**
	 * EmbedImage constructor.
	 * @param string $url The image URL
	 * @param string $proxy_url does not function.
	 * @param int $height The height of the image.
	 * @param int $width The width of the image.
	 */
	public function __construct(string $url = '', string $proxy_url = '', int $height = 0, int $width = 0){
		parent::__construct($url, $height, $width);
		$this->proxy_url = $proxy_url;
	}

	/**
	 * Convert the object into an associative array.
	 * @return array
	 */
	public function jsonSerialize(){
		$data = parent::jsonSerialize();
		$data['proxy_url'] = $this->proxy_url;
		return array_filter($data);
	}
}