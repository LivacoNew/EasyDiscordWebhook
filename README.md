# EasyDiscordWebhook
EasyDiscordWebhook is a simple library to allow you to send Discord Webhooks easily.

## Installation
EasyDiscordWebhook can be installed via Composer:
`composer require livaco/easydiscordwebhook`

## Usage
There are three main classes, each responsible for a particular part of the webhook, but it's still really easy.

Step 1 is to load your composer autoload file.
Step 2 is to create the webhook object.
Step 3 is to make a message.
Step 4 is to send it. 
```php
require __DIR__ . '/vendor/autoload.php';

use Livaco\EasyDiscordWebhook\DiscordWebhook;
use Livaco\EasyDiscordWebhook\WebhookPayload;

$webhook = new DiscordWebhook("https://discordapp.com/api/{some id}/{some token}"); // Create the Webhook object.
$message = new WebhookPayload();
$message->setContent("This is a test of the emergency webhook system.");
$webhook->execute($message);
``` 
This generates a basic webhook.
![Basic Example](https://i.doctor-internet.dev/bofamYwcg04b)

However, EasyDiscordWebhook also supports Embeds. These can be done easily like this:
```php
require __DIR__ . '/vendor/autoload.php';

use Livaco\EasyDiscordWebhook\DiscordWebhook;
use Livaco\EasyDiscordWebhook\WebhookPayload;
use Livaco\EasyDiscordWebhook\RichEmbed;

$embed = new RichEmbed();
$embed->setColor('#FF00FF');
$embed->setFooter('This is a footer');
$embed->setAuthor('Livaco', 'https://livaco.dev', 'https://cdn1.iconfinder.com/data/icons/social-media-vol-1-1/24/_github-512.png');
$embed->addField('Test', 'No u');
$embed->addField('Test 2', 'No u2', true);
$embed->addField('Test 3', 'No through', true);

$message = new WebhookPayload();
$message->addEmbed($embed);

$webhook = new DiscordWebhook("https://discordapp.com/api/{some id}/{some token}"); // Create the Webhook object.
$webhook->execute($message);
```
This generates a basic embed.<br>
![Basic Embed Example](https://i.doctor-internet.dev/ZokLFQJDyMSW)

You can view all the possibilities on the wiki.
