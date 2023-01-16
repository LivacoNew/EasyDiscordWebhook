<?php 
// Creates a basic webhook message, using embeds.
// Result: https://upload.livaco.dev/u/v0swolM9Ik.png

require_once 'vendor/autoload.php';

use Livaco\EasyDiscordWebhook\DiscordWebhook;
use Livaco\EasyDiscordWebhook\Objects\Embed;

DiscordWebhook::new("https://discord.com/api/webhooks/your/webhook")
    ->addEmbed(Embed::new()
        ->setTitle("This is the title of the embed.")
        ->setDescription("And this is a description!")
        ->setColor("#BB3C8D"))
    ->execute();