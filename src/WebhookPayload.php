<?php


namespace Livaco\EasyDiscordWebhook;


use JsonSerializable;

/**
 * This class represents a message being sent to discord.
 * Class WebhookPayload
 * @package Livaco\EasyDiscordWebhook
 */
class WebhookPayload implements JsonSerializable {
	private $content;
	private $username;
	private $avatar;
	private $tts;
	private $embeds = [];

	/**
	 * Sets the message of the message.
	 * @param string $content
	 * @return $this
	 */
	public function setContent(string $content): self{
		$this->content = $content;
		return $this;
	}

	/**
	 * Sets the display username for the message.
	 * @param string $username
	 * @return $this
	 */
	public function setUsername(string $username): self{
		$this->username = $username;
		return $this;
	}

	/**
	 * Sets the avatar for the image.
	 * @param string $avatar
	 * @return $this
	 */
	public function setAvatar(string $avatar): self{
		$this->avatar = $avatar;
		return $this;
	}

	/**
	 * Sets if this message is TTS
	 * @param bool $tts
	 * @return $this
	 */
	public function setTTS(bool $tts): self{
		$this->tts = $tts;
		return $this;
	}

	/**
	 * Adds an embed to the message.
	 * @param RichEmbed $embed
	 * @return $this
	 */
	public function addEmbed(RichEmbed $embed): self{
		$this->embeds[] = $embed;
		return $this;
	}

	/**
	 * Turn this embed into a assoc array.
	 * @return array
	 */
	public function jsonSerialize(): array{
		return array_filter([
			'content' => $this->content,
			'username' => $this->username,
			'avatar_url' => $this->avatar,
			'tts' => $this->tts,
			'embeds' => array_map(function($embed){return $embed->jsonSerialize();}, $this->embeds)
		]);
	}
}