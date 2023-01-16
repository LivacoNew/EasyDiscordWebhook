<?php 
// Webhooks have something called Allowed Mentions, which will dictate what your allowed to mention. This is useful if your dealing with user data, and you don't want to allow them to mention everyone or roles.
// Result: https://upload.livaco.dev/u/Ztwofydhjn.png

require_once 'vendor/autoload.php';

use Livaco\EasyDiscordWebhook\DiscordWebhook;
use Livaco\EasyDiscordWebhook\Objects\AllowedMentions;

DiscordWebhook::new("https://discord.com/api/webhooks/your/webhook")
    ->setContent("Hi, @everyone! Oh btw <@492040754743476239> you stink, and everyone thats <@&677955267584983042> is cool.\nThis ping won't work!")
    ->setAllowedMentions(AllowedMentions::none())
    ->execute();
DiscordWebhook::new("https://discord.com/api/webhooks/your/webhook")
    ->setContent("Hi, @everyone! Oh btw <@492040754743476239> you stink, and everyone thats <@&677955267584983042> is cool.\nThis ping will only use @everyone!")
    ->setAllowedMentions(AllowedMentions::everyone())
    ->execute();
DiscordWebhook::new("https://discord.com/api/webhooks/your/webhook")
    ->setContent("Hi, @everyone! Oh btw <@492040754743476239> you stink, and everyone thats <@&677955267584983042> is cool.\nThis ping will only use @Livaco!")
    ->setAllowedMentions(AllowedMentions::users())
    ->execute();
DiscordWebhook::new("https://discord.com/api/webhooks/your/webhook")
    ->setContent("Hi, @everyone! Oh btw <@492040754743476239> you stink, and everyone thats <@&677955267584983042> is cool.\nThis ping will only use @unverified!")
    ->setAllowedMentions(AllowedMentions::roles())
    ->execute();