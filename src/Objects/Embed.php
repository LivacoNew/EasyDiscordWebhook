<?php
namespace Livaco\EasyDiscordWebhook\Objects;

/**
 * A rich embed that goes into a webhook.
 * @author Livaco
 */
class Embed {
    private array $data;

    /**
     * Constructs a new embed object.
     * @internal
     */
    public function __construct() {
        $this->data = [];
    }

    /**
     * Creates a new embed object.
     * @return Embed The embed object.
     */
    public static function new() {
        return new Embed();
    }

    /**
     * Sets the title of the embed.
     * @param ?string $title The title of the embed.
     * @return Embed The embed object.
     */
    public function setTitle(?string $title) {
        if($title == null) {
            $this->data['title'] = null;
            return $this;
        }

        $this->data['title'] = $title;
        return $this;
    }

    /**
     * Sets the description of the embed.
     * @param ?string $description The description of the embed.
     * @return Embed The embed object.
     */
    public function setDescription(?string $description) {
        if($description == null) {
            $this->data['description'] = null;
            return $this;
        }

        $this->data['description'] = $description;
        return $this;
    }

    /**
     * Sets the URL of the embed, using the title as a hyperlink.
     * @param ?string $url The URL of the embed.
     * @return Embed The embed object.
     */
    public function setUrl(?string $url) {
        if($url == null) {
            $this->data['url'] = null;
            return $this;
        }

        $this->data['url'] = $url;
        return $this;
    }

    /**
     * Sets the timestamp of the embed.
     * @param ?string $timestamp The timestamp of the embed. **Must be in ISO8601 format.**
     * @return Embed The embed object.
     */
    public function setTimestamp(?string $timestamp) {
        if($timestamp == null) {
            $this->data['timestamp'] = null;
            return $this;
        }

        $this->data['timestamp'] = $timestamp;
        return $this;
    }

    /**
     * Sets the color of the embed.
     * @param ?string $color The color of the embed, in hex format (#rrggbb).
     * @return Embed The embed object.
     */
    public function setColor(?string $color) {
        if($color == null) {
            $this->data['color'] = null;
            return $this;
        }

        $this->data['color'] = hexdec($color);
        return $this;
    }

    /**
     * Sets the footer of the embed.
     * @param ?string $text The text of the footer.
     * @param ?string $iconUrl The icon URL of the footer.
     * @return Embed The embed object.
     */
    public function setFooter(?string $text, ?string $iconUrl = null) {
        if($text == null) {
            $this->data['footer'] = null;
            return $this;
        }

        $this->data['footer'] = [
            'text' => $text,
            'icon_url' => $iconUrl
        ];
        return $this;
    }

    /**
     * Sets the image of the embed.
     * @param ?string $url The URL of the image.
     * @return Embed The embed object.
     */
    public function setImage(?string $url) {
        if($url == null) {
            $this->data['image'] = null;
            return $this;
        }

        $this->data['image'] = [
            'url' => $url
        ];
        return $this;
    }

    /**
     * Sets the thumbnail of the embed.
     * @param ?string $url The URL of the thumbnail.
     * @return Embed The embed object.
     */
    public function setThumbnail(?string $url) {
        if($url == null) {
            $this->data['thumbnail'] = null;
            return $this;
        }

        $this->data['thumbnail'] = [
            'url' => $url
        ];
        return $this;
    }

    /**
     * Sets the author of the embed.
     * @param ?string $name The name of the author.
     * @param ?string $url The URL of the author.
     * @param ?string $iconUrl The icon URL of the author.
     * @return Embed The embed object.
     */
    public function setAuthor(?string $name, ?string $url = null, ?string $iconUrl = null) {
        if($name == null) {
            $this->data['author'] = null;
            return $this;
        }

        $this->data['author'] = [
            'name' => $name,
            'url' => $url,
            'icon_url' => $iconUrl
        ];
        return $this;
    }

    /**
     * Adds a field to the embed.
     * @param ?string $name The name of the field.
     * @param ?string $value The value of the field.
     * @param bool $inline Whether the field should be inline or not.
     * @return Embed The embed object.
     */
    public function addField(?string $name, ?string $value, bool $inline = false) {
        if($name == null || $value == null) {
            return $this;
        }

        $this->data['fields'][] = [
            'name' => $name,
            'value' => $value,
            'inline' => $inline
        ];
        return $this;
    }

    /**
     * Gets the data of the embed.
     * @return array The data of the embed.
     * @internal
     */
    public function data() {
        return $this->data;
    }
}