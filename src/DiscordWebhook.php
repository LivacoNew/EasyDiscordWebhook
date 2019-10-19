<?php

namespace Livaco\EasyDiscordWebhook;

/**
 * The discord webhook class represents a webhook endpoint, and contains functions for sending payloads to it.
 * Class DiscordWebhook
 * @package Livaco\EasyDiscordWebhook
 */
class DiscordWebhook {
	/** @var string */
	private $url = '';

	/**
	 * DiscordWebhook constructor.
	 * @param string $url Either the full webhook URL or the webhook ID (assuming webhook token is not empty)
	 * @param string $token The webhook token.
	 */
    public function __construct(string $url, string $token = ''){
    	if (empty($token)){
    		// We assume the URL is full.
			$this->url = $url;
		} else {
    		// Or we build the URL from the token and webhook ID.
			$this->url = "https://discordapp.com/api/webhooks/{$url}/{$token}";
		}
    }

	/**
	 * Execute the webhook with the given payload.
	 * @param WebhookPayload $payload The data to send to discord.
	 * @param bool $await If we should wait for discord to confirm the message.
	 * @return bool|string Discord's return message.
	 */
    public function execute(WebhookPayload $payload, bool $await = false){
    	$json = json_encode($payload);
    	$json_length = strlen($json);

		$ch = curl_init($this->url . ($await ? '?wait=true' : ''));
		curl_setopt_array($ch, [
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $json,
			CURLOPT_RETURNTRANSFER => true,

			CURLOPT_HTTPHEADER => [
				"Length" => $json_length,
				"Content-Type" => "application/json"
			]
		]);

		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}
}
