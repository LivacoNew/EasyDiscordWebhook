<?php

require __DIR__ . '/vendor/autoload.php';

$emb = new \Livaco\EasyDiscordWebhook\RichEmbed();
$emb->setColor('#FF00FF')
	->setFooter('Footer', 'https://cdn1.iconfinder.com/data/icons/social-media-vol-1-1/24/_github-512.png')
	->setAuthor('John Internet', 'https://doctor-internet.dev', 'https://doctor-internet.dev/img/logo.png')
	->addField('Test', 'No u')
	->addField('Test 2', 'No u2', true)
	->addField('Test 3', 'No poo', true);

var_dump($emb->jsonSerialize());

$whpl = new \Livaco\EasyDiscordWebhook\WebhookPayload();
$whpl->addEmbed($emb);
$whpl->setContent('asdbasdasd');

$wh = new \Livaco\EasyDiscordWebhook\DiscordWebhook($_SERVER['DISCORD_URL']);
$wh->execute($whpl);