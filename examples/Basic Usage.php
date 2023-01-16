<?php 
// Creates a basic webhook message.
// Result: https://upload.livaco.dev/u/YW1VTcwFlQ.png

require_once 'vendor/autoload.php';

use Livaco\EasyDiscordWebhook\DiscordWebhook;

DiscordWebhook::new("https://discord.com/api/webhooks/your/webhook")
    ->setContent("Hello world! This is a discord webhook message.")
    ->execute();