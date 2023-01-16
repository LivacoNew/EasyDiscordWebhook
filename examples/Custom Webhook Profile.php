<?php 
// Creates a webhook message, but using a custom webhook name and avatar.
// Result: https://upload.livaco.dev/u/1gSptFY40y.png

require_once 'vendor/autoload.php';

use Livaco\EasyDiscordWebhook\DiscordWebhook;

DiscordWebhook::new("https://discord.com/api/webhooks/your/webhook")
    ->setUsername("Judy")
    ->setAvatarUrl("https://upload.livaco.dev/u/ih54R9A3Xm.png")
    ->setContent("Hi, I'm using a username and avatar different from the webhook's default!")
    ->execute();