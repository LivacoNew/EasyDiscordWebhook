# EasyDiscordWebhook
EasyDiscordWebhook is a simple library to allow you to send Discord Webhooks easily.

## Installation
EasyDiscordWebhook can be installed via Composer:
`composer require livaco/easydiscordwebhook`

## Usage:
Using the webhook is easy. First, do your composer autoload and create the webhook class.
```php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use Livaco\EasyDiscordWebhook\DiscordWebhook;

$webhook = new DiscordWebhook("your_webhook_url_here"); // Create the Webhook object.
$webhook->setContents("This is a Test Webhook."); // Set the contents of the webhook.
$webhook->sendWebhook(); // Send the webhook.
``` 
This generates a basic webhook.<br>
![Basic Example](https://upload.livaco.dev/u/65psw3YtU2.png)
<br><br>
However, EasyDiscordWebhook also supports Embeds. These can be done easily like this:
```php
use Livaco\EasyDiscordWebhook\DiscordWebhook;

$webhook = new DiscordWebhook("your_webhook_url_here"); // Create the Webhook object.
$webhook->setTitle("Basic Webhook"); // Set the title of the embed.
$webhook->setDescription("This is a basic webhook embed."); // Set the description of the embed.
$webhook->setColor("#48f542"); // Set the color of the webhook.
$webhook->setTimestamp(date("c")); // Set the timestamp of the embed.

$webhook->sendWebhook(); // Send the webhook.
```
This generates a basic embed.<br>
![Basic Embed Example](https://upload.livaco.dev/u/ofrz6F0ues.png)
<br><br>
You can view all the possibilities on the wiki.
