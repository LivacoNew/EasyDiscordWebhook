# EasyDiscordWebhook
EasyDiscordWebhook is a simple, easy to use library to allow you to create and send discord webhooks in PHP with minimal effort.  

## Installation
EasyDiscordWebhook can be installed just like any other composer package.  
`composer require livaco\easydiscordwebhook`

## Usage
To get started, we'll start by making a `DiscordWebhook` object. This is done as such.
```php
$webhook = DiscordWebhook::new("https://discord.com/api/webhooks/your/webhook");
```
The argument in the `new` function is for your webhook url.  
Next, we can begin setting what our webhook should contain. Every webhook requires either text in the content, or at least one embed.  
We'll keep it simple for now though, and just have it say o'l "Hello, world!". EasyDiscordWebhook supports fluent interface, so we'll use that as well and get rid of the `$webhook` variable.  
To set the content of the webhook, we'll use the `setContent` function. To send it, you from here just need to call the `execute` function.
```php
DiscordWebhook::new("https://discord.com/api/webhooks/your/webhook")
    ->setContent("Hello, world!")
    ->execute();
```
![The webhook that was sent](https://upload.livaco.dev/u/0CEQT8MGoW.png)  
  
Cool, right? Let's add an embed now. Let's pretend it's a game information webhook, and we want some basic information about Cyberpunk 2077 (I suck at examples, so this is the best I got).  
Embeds are added using the `addEmbed` function. From there, we can feed it an embed object that has all the information attached to it. Once again, we create this object using `Embed::new()` and from there we can use the functions provided to fill out the data.
```php
DiscordWebhook::new("https://discord.com/api/webhooks/your/webhook")
    ->addEmbed(Embed::new()
        ->setTitle("Cyberpunk 2077")
        ->setDescription("Cyberpunk 2077 is an open-world, action-adventure RPG set in the megalopolis of Night City, where you play as a cyberpunk mercenary wrapped up in a do-or-die fight for survival. Improved and featuring all-new free additional content, customize your character and playstyle as you take on jobs, build a reputation, and unlock upgrades. The relationships you forge and the choices you make will shape the story and the world around you. Legends are made here. What will yours be?")
        ->addField("Release Date", "December 10, 2020", true)
        ->addField("Platforms", "All Major Platforms", true)
        ->addField("Developer", "CD Projekt Red", true)
        ->setColor("#FCFF2B")
        ->setUrl("https://www.cyberpunk.net/gb/en/")
        ->setImage("https://upload.livaco.dev/u/nYLGepk6X2.png")
    )
    ->execute();
```
![The webhook that was posted](https://upload.livaco.dev/u/PrwU3YgfMW.png)  

If you want more examples, take a look in /examples.