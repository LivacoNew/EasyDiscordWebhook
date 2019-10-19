<?php

namespace Livaco\EasyDiscordWebhook;

class DiscordWebhook {
	private $url = '';

    public function __construct(string $url, string $token = ''){
    	if (empty($token)){
    		// We assume the URL is full.
			$this->url = $url;
		} else {
    		// Or we build the URL from the token and webhook ID.
			$this->url = "https://discordapp.com/api/webhooks/{$url}/{$token}";
		}
    }

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
