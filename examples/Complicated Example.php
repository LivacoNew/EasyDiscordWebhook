<?php 
// A complicated embed example, that's providing a launch update on the falcon heavy test flight, themed off https://www.interstellarbot.xyz
// Result: https://upload.livaco.dev/u/iqFpZXkcP5.png

require_once 'vendor/autoload.php';

use Livaco\EasyDiscordWebhook\DiscordWebhook;
use Livaco\EasyDiscordWebhook\Objects\AllowedMentions;
use Livaco\EasyDiscordWebhook\Objects\Embed;

DiscordWebhook::new("https://discord.com/api/webhooks/your/webhook")
    ->setUsername("Launches")
    ->setAvatarUrl("https://cdn.discordapp.com/icons/707928374600925264/89fcb09086540a46b5f9ce59a09a46ad.png")
    ->setContent("2 new launch updates are available!")
    ->setAllowedMentions(AllowedMentions::none())
    ->addEmbed(Embed::new()
        ->setTitle("Launch Update")
        ->setDescription("Side booster seperation. Both boosters will perform a boostback burn before returning to earth for a pad landing.")
        ->setAuthor("Livaco", "https://www.livaco.dev", "https://upload.livaco.dev/u/ih54R9A3Xm.png")
        ->setUrl("https://www.youtube.com/watch?v=wbSwFU6tY1c")
        ->setImage("https://upload.livaco.dev/u/vE2fQueNxt.png")
        ->setFooter("Falcon Heavy Test Flight", "https://cdn.discordapp.com/icons/707928374600925264/89fcb09086540a46b5f9ce59a09a46ad.png")
        ->setTimestamp(date("c"))
        ->setColor("#BB3C8D"))
    ->execute();