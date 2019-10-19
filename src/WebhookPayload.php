<?php


namespace Livaco\EasyDiscordWebhook;


class WebhookPayload implements \JsonSerializable {
	private $content;
	private $username;
	private $avatar;
	private $tts;
	private $embeds = [];

	public function setContent(string $content): self{
		$this->content = $content;
		return $this;
	}

	public function setUsername(string $username): self{
		$this->username = $username;
		return $this;
	}

	public function setAvatar(string $avatar): self{
		$this->avatar = $avatar;
		return $this;
	}

	public function setTTS(bool $tts): self{
		$this->tts = $tts;
		return $this;
	}

	public function addEmbed(RichEmbed $embed): self{
		$this->embeds[] = $embed;
		return $this;
	}

	public function jsonSerialize(){
		return array_filter([
			'content' => $this->content,
			'username' => $this->username,
			'avatar_url' => $this->avatar,
			'tts' => $this->tts,
			'embeds' => array_map(function($embed){return $embed->jsonSerialize();}, $this->embeds)
		]);
	}
}