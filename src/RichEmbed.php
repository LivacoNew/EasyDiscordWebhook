<?php


namespace Livaco\EasyDiscordWebhook;


use DateTime;
use JsonSerializable;
use DateTimeInterface;

class RichEmbed implements jsonSerializable {
	private $title;
	private $description;
	private $url;
	/** @var DateTimeInterface */
	private $timestamp;
	/** @var Color */
	private $color;
	/** @var EmbedFooter */
	private $footer;
	/** @var EmbedImage */
	private $image;
	/** @var EmbedImage */
	private $thumbnail;
	/** @var EmbedVideo */
	private $video;
	/** @var EmbedProvider */
	private $provider;
	/** @var EmbedAuthor */
	private $author;
	/** @var EmbedField[] */
	private $fields = [];

	/** Set the title of the embed.
	 * @param string $title
	 * @return RichEmbed
	 */
	public function setTitle(string $title): self{
		$this->title = $title;
		return $this;
	}

	/**
	 * @param string $description
	 * @return RichEmbed
	 */
	public function setDescription(string $description): self{
		$this->description = $description;
		return $this;
	}

	/**
	 * @param string $url
	 * @return RichEmbed
	 */
	public function setURL(string $url): self{
		$this->url = $url;
		return $this;
	}

	/**
	 * @param int|DateTimeInterface $timestamp
	 * @param string $format
	 * @return RichEmbed
	 */
	public function setTimestamp($timestamp, string $format=''): self{
		if ($timestamp instanceof DateTimeInterface){
			$this->timestamp = clone $timestamp;
		} elseif (is_numeric($timestamp)){
			$this->timestamp = DateTime::createFromFormat('U', $timestamp);
		} elseif ($format){
			$this->timestamp = DateTime::createFromFormat($format, $timestamp);
		}

		return $this;
	}

	/**
	 * @param mixed $color
	 * @return RichEmbed
	 */
	public function setColor($color): self{
		if (is_numeric($color)){
			$this->color = Color::fromDecimal($color);
		} elseif (is_string($color)){
			$this->color = Color::fromHex($color);
		} elseif ($color instanceof Color){
			$this->color = clone $color;
		}

		return $this;
	}

	public function setFooter(string $text, string $icon = '', string $proxy_icon = ''): self{
		$this->footer = new EmbedFooter($text, $icon, $proxy_icon);
		return $this;
	}

	public function setAuthor(string $name = '', string $url = '', string $icon = '', string $proxy_icon = ''): self{
		$this->author = new EmbedAuthor($name, $url, $icon, $proxy_icon);
		return $this;
	}

	public function setImage(string $url = '', string $proxy = '', int $height = 0, int $width = 0): self{
		$this->image = new EmbedImage($url, $proxy, $height, $width);
		return $this;
	}

	public function setThumbnail(string $url = '', string $proxy = '', int $height = 0, int $width = 0): self{
		$this->thumbnail = new EmbedImage($url, $proxy, $height, $width);
		return $this;
	}

	public function setVideo(string $url = '', int $height = 0, int $width = 0): self{
		$this->video = new EmbedVideo($url, $height, $width);
		return $this;
	}

	public function setProvider(string $name = '', string $url = ''): self{
		$this->provider = new EmbedProvider($name, $url);
		return $this;
	}

	public function addField(string $name, string $value, $inline = false){
		$this->fields[] = new EmbedField($name, $value, $inline);
		return $this;
	}

	public function jsonSerialize(){
		return array_filter([
			'title' => $this->title,
			'type' => 'rich',
			'description' => $this->description,
			'url' => $this->url,
			'timestamp' => isset($this->timestamp) ? $this->timestamp->format(DATE_ISO8601) : false,
			'color' => isset($this->color) ? $this->color->jsonSerialize() : 0,
			'footer' => isset($this->footer) ? $this->footer->jsonSerialize() : false,
			'image' => isset($this->image) ? $this->image->jsonSerialize() : false,
			'thumbnail' => isset($this->thumbnail) ? $this->thumbnail->jsonSerialize() : false,
			'video' => isset($this->video) ? $this->video->jsonSerialize() : false,
			'provider' => isset($this->provider) ? $this->provider->jsonSerialize() : false,
			'author' => isset($this->author) ? $this->author->jsonSerialize() : false,
			'fields' => array_map(function($field){return $field->jsonSerialize();}, $this->fields)
		]);
	}
}