<?php

namespace Livaco\EasyDiscordWebhook;

class DiscordWebhook {
    private $contents;

    private $hasRich;
    private $title;
    private $titleURL;
    private $description;
    private $color;
    private $timestamp;
    private $footer;
    private $thumbnail;
    private $image;
    private $author;
    private $fields = array();

    private $url;

    /**
    * Creates a new Webhook instance.
    *
    * @param string $uri The URL for the webhook.
    */
    public function __construct(string $url) {
        $this->url = $url;
    }

    /**
    * Sets the contents of a Webhook.
    *
    * @param string $text The text that the contents will be set to.
    */
    public function setContents(string $text) {
        $this->contents = $text;
    }

    /**
    * Sets the embed title.
    *
    * @param string $text The title text.
    * @param string $url The URL of the title. Optional.
    */
    public function setTitle(string $text, string $url = null) {
        $this->hasRich = true;
        $this->title = $text;
        if($url != null) {
            $this->titleURL = $url;
        }
    }

    /**
    * Sets the embed description.
    *
    * @param string $text The description.
    */
    public function setDescription(string $text) {
        $this->hasRich = true;
        $this->description = $text;
    }

    /**
    * Sets the embed color.
    *
    * @param string $hex The HEX color.
    */
    public function setColor(string $hex) {
        $this->hasRich = true;
        $this->color = hexdec($hex);
    }

    /**
    * Sets the Timestamp of the webhook.
    *
    * @param string $time The timestamp. MUST be a ISO 8601 date.
    */
    public function setTimestamp(string $time) {
        $this->hasRich = true;
        $this->timestamp = $time;
    }

    /**
    * Sets the footer.
    *
    * @param string $text The footer text.
    * @param string $icon The icon image URL.
    */
    public function setFooter(string $text, string $icon = null) {
        $this->hasRich = true;
        $this->footer['text'] = $text;
        if($icon != null) {
            $this->footer['icon'] = $icon;
        } else {
            $this->footer['icon'] = null;
        }
    }

    /**
    * Sets the thumbnail image URL.
    *
    * @param string $url The image URL.
    */
    public function setThumbnail(string $url) {
        $this->hasRich = true;
        $this->thumbnail = $url;
    }

    /**
    * Sets the image URL.
    *
    * @param string $url The image URL.
    */
    public function setImage(string $url) {
        $this->hasRich = true;
        $this->image = $url;
    }

    /**
    * Sets the author.
    *
    * @param string $name The name of the author.
    * @param string $url The URL of the author. Optional.
    * @param string $icon The icon of the author. Optional.
    */
    public function setAuthor(string $name, string $url = null, string $icon = null) {
        $this->hasRich = true;
        $this->author['name'] = $name;
        if($url != null) {
            $this->author['url'] = $url;
        } else {
            $this->author['url'] = null;
        }
        if($icon != null) {
            $this->author['icon'] = $icon;
        } else {
            $this->author['icon'] = null;
        }
    }

    /**
    * Adds a new Field.
    *
    * @param string $title The title of the field.
    * @param string $content The content the field contains.
    * @param bool $inline If the field is inline or not. Optional.
    */
    public function addField(string $title, string $content, bool $inline = false) {
        $this->hasRich = true;
        $field = [
            "name" => $title,
            "value" => $content,
            "inline" => $inline
        ];
        array_push($this->fields, $field);
    }

    /**
    * Builds the webhook JSON.
    *
    * @return string|false The JSON for the Webhook. False if error.
    */
    public function generateJSON() {
        if($this->contents == null && $this->hasRich == false) {
            return false;
        }

        $result = [];

        if($this->contents != null) {
            $result['content'] = $this->contents;
        }

        if($this->hasRich) {
            $embed = [];
            if($this->title != null) {
                $embed['title'] = $this->title;
                if($this->title != null) {
                    $embed['url'] = $this->titleURL;
                }
            }

            if($this->description != null) {
                $embed['description'] = $this->description;
            }

            if($this->color != null) {
                $embed['color'] = $this->color;
            }

            if($this->timestamp != null) {
                $embed['timestamp'] = $this->timestamp;
            }

            if($this->footer != null) {
                $embed['footer']['text'] = $this->footer['text'];
                if($this->footer['icon'] != null) {
                    $embed['footer']['icon_url'] = $this->footer['icon'];
                }
            }

            if($this->thumbnail != null) {
                $embed['thumbnail']['url'] = $this->thumbnail;
            }
            if($this->image != null) {
                $embed['image']['url'] = $this->image;
            }

            if($this->author != null) {
                $embed['author']['name'] = $this->author['name'];
                if($this->author['url'] != null) {
                    $embed['author']['url'] = $this->author['url'];
                }
                if($this->author['icon'] != null) {
                    $embed['author']['icon_url'] = $this->author['icon'];
                }
            }

            if($this->fields != null) {
                $embed['fields'] = array();
                foreach($this->fields as $key => $value) {
                    array_push($embed['fields'], $value);
                }
            }

            $result['embeds'][] = $embed;
        }
        //print_r($result);
        //echo("<br><br>");
        return json_encode($result, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
    * Sends a CURL request to trigger the webhook.
    */
    public function sendWebhook() {
        $json = $this->generateJSON();
        if(!$json) {
            return;
        }
        //echo($json);

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $this->url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $json,
            CURLOPT_HTTPHEADER => [
                "Length" => strlen($json),
                "Content-Type" => "application/json"
            ]
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
    }
}