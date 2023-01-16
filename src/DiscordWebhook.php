<?php 
namespace Livaco\EasyDiscordWebhook;

use UnexpectedValueException;
use Livaco\EasyDiscordWebhook\Exceptions\WebhookErrorException;
use Livaco\EasyDiscordWebhook\Objects\AllowedMentions;
use Livaco\EasyDiscordWebhook\Objects\Embed;

/**
 * A discord webhook object.
 * @author Livaco
 */
class DiscordWebhook {
    private string $url;
    private array $data;

    /**
     * Construcst the webhook object.
     * @param string $url The URL of the webhook.
     */
    private function __construct(string $url) {
        $this->url = $url;
        $this->data = [];
    }

    /**
     * Creates a new webhook.
     * @param string $url The URL of the webhook.
     * @return DiscordWebhook The webhook object.
     */
    public static function new(string $url) {
        return new DiscordWebhook($url);
    }

    /**
     * Sets the content of the webhook.
     * @param ?string $text The content, max of 2000 characters.
     * @return DiscordWebhook The webhook object.
     * @throws UnexpectedValueException If the content is over 2000 characters.
     */
    public function setContents(?string $text) {
        if($text == null) {
            $this->data['content'] = null;
            return;
        }
        $length = strlen($text);
        if($length > 2000 || $length <= 0) {
            throw new UnexpectedValueException("Webhook content must be between 1 and 2000 characters long.");
        }

        $this->data['content'] = $text;
        return $this;
    }

    /**
     * Set the username of the webhook sender.
     * @param ?string $username The username to use, max of 32 characters.
     * @return DiscordWebhook The webhook object.
     * @throws UnexpectedValueException If the username is over 32 characters.
     */
    public function setUsername(?string $username) {
        if($username == null) {
            $this->data['username'] = null;
            return;
        }
        $length = strlen($username);
        if($length > 32 || $length <= 0) {
            throw new UnexpectedValueException("Webhook username must be between 1 and 32 characters long.");
        }

        $this->data['username'] = $username;
        return $this;
    }

    /**
     * Set the avatar of the webhook sender.
     * @param ?string $url The URL of the avatar to use.
     * @return DiscordWebhook The webhook object.
     */
    public function setAvatarUrl(?string $url) {
        if($url == null) {
            $this->data['avatar_url'] = null;
            return;
        }
        if(strlen($url) <= 0) {
            $this->data['avatar_url'] = null;
            return;
        }

        $this->data['avatar_url'] = $url;
        return $this;
    }

    /**
     * Set if this message should be a text-to-speech message.
     * @param bool $tts Whether this message should be a text-to-speech message.
     * @return DiscordWebhook The webhook object.
     */
    public function setTTS(bool $tts) {
        $this->data['tts'] = $tts;
        return $this;
    }

    /**
     * Set the name of the thread to create with this. 
     * **Note:** This will only work if the webhook is in a channel that allows threads.
     * @param ?string $thread The name of the thread to create.
     * @return DiscordWebhook The webhook object.
     */
    public function setThreadTitle(?string $thread) {
        if($thread == null) {
            $this->data['thread_name'] = null;
            return;
        }

        $this->data['thread_name'] = $thread;
        return $this;
    }

    /**
     * Set the mentions that are allowed to be done in this message. By default allows all mentions.
     * @param ?AllowedMentions $mentions The mentions to allow.
     * @return DiscordWebhook The webhook object.
     */
    public function setAllowedMentions(?AllowedMentions $mentions) {
        if($mentions == null) {
            $this->data['allowed_mentions'] = null;
            return;
        }

        $this->data['allowed_mentions'] = $mentions->data();
        return $this;
    }

    /**
     * Adds a rich embed to the webhook. A max of 10 embeds can be attached to one message.
     * @param Embed $embed The embed to add.
     * @return DiscordWebhook The webhook object.
     * @throws UnexpectedValueException If the webhook already has 10 embeds.
     */
    public function addEmbed(Embed $embed) {
        if(!isset($this->data['embeds'])) {
            $this->data['embeds'] = [];
        }
        if(count($this->data['embeds']) >= 10) {
            throw new UnexpectedValueException("Webhook can only have up to 10 embeds.");
        }
        $this->data['embeds'][] = $embed->data();
        return $this;
    }

    /**
     * Executes the webhook.
     * @throws UnexpectedValueException If the webhook URL has not been set.
     * @throws UnexpectedValueException If the webhook has no content, embeds or file.
     * @throws WebhookErrorException If the endpoint returns an error.
     */
    public function execute() {
        if($this->url == null) {
            throw new UnexpectedValueException("Webhook URL is null.");
        }
        if(!array_key_exists('content', $this->data)
            && !array_key_exists('embeds', $this->data)) {
            throw new UnexpectedValueException("Webhook must have at least one of content or embeds.");
        }
        $json = json_encode($this->data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $this->url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $json,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Length: ' . strlen($json),
                'Content-Type: application/json'
            ]
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        if($response != "") {
            // Something's wrong
            throw new WebhookErrorException($response);
        }
    }
}