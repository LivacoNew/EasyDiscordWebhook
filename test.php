<?php

use Livaco\EasyDiscordWebhook\RichEmbed;
use Livaco\EasyDiscordWebhook\WebhookPayload;
use Livaco\EasyDiscordWebhook\DiscordWebhook;

require __DIR__ . '/vendor/autoload.php';

$emb = new \Livaco\EasyDiscordWebhook\RichEmbed();
$emb->setColor('#FF00FF')
	->setFooter('Footer', 'https://cdn1.iconfinder.com/data/icons/social-media-vol-1-1/24/_github-512.png')
	->setAuthor('John Internet', 'https://doctor-internet.dev', 'https://doctor-internet.dev/img/logo.png')
	->addField('Test', 'No u')
	->addField('Test 2', 'No u2', true)
	->addField('Test 3', 'No poo', true);

$message = new WebhookPayload();
$message->setContent("This is a test of the emergency webhook system.");

$wh = new DiscordWebhook($_SERVER['DISCORD_URL']);
$wh->execute($message);

$embed = new RichEmbed();
$embed->setColor('#FF00FF');
$embed->setFooter('This is a footer');
$embed->setAuthor('Livaco', 'https://livaco.dev', 'https://cdn1.iconfinder.com/data/icons/social-media-vol-1-1/24/_github-512.png');
$embed->addField('Test', 'No u');
$embed->addField('Test 2', 'No u2', true);
$embed->addField('Test 3', 'No through', true);

$message = new WebhookPayload();
$message->addEmbed($embed);

$webhook = new DiscordWebhook($_SERVER['DISCORD_URL']); // Create the Webhook object.
$webhook->execute($message);