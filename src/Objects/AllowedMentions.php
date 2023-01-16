<?php
namespace Livaco\EasyDiscordWebhook\Objects;

/**
 * An object for allowed mentions. This allows control over who can be mentioned inside a webhook message.
 * @author Livaco
 */
class AllowedMentions {
    private array $data;

    /**
     * Constructs a new allowed mentions object.
     * @param array $defaultParse The default parse array.
     * @param ?array $defaultRoles The default roles array.
     * @param ?array $defaultUsers The default users array.
     * @internal
     */
    private function __construct(array $defaultParse = [], ?array $defaultRoles = null, ?array $defaultUsers = null) {
        $this->data = [
            'parse' => $defaultParse,
            'roles' => $defaultRoles,
            'users' => $defaultUsers
        ];
    }

    /**
     * Supress all mentions inside the webhook.
     * @return AllowedMentions The allowed mentions object.
     */
    public static function none() {
        return new AllowedMentions();
    }

    /**
     * Allow mentions targeting @everyone and @here inside the webhook.
     * @return AllowedMentions The allowed mentions object.
     */
    public static function everyone() {
        return new AllowedMentions(['everyone']);
    }

    /**
     * Allow mentions targeting roles inside the webhook.
     * @param ?array $roles The roles to allow mentions for. If null, all roles will be allowed.
     * @return AllowedMentions The allowed mentions object.
     */
    public static function roles(?array $roles = null) {
        if($roles == null) {
            return new AllowedMentions(['roles']);
        }
        return new AllowedMentions([], $roles);
    }

    /**
     * Allow mentions targeting users inside the webhook.
     * @param ?array $users The users to allow mentions for. If null, all users will be allowed.
     * @return AllowedMentions The allowed mentions object.
     */
    public static function users(?array $users = null) {
        if($users == null) {
            return new AllowedMentions(['users']);
        }
        return new AllowedMentions([], null, $users);
    }

    /**
     * Allow mentions targeting @everyone and @here inside the webhook.
     * @return AllowedMentions The allowed mentions object.
     */
    public function allowEveryone() {
        $this->data['parse'][] = 'everyone';
        return $this;
    }

    /**
     * Allow mentions targeting roles inside the webhook.
     * @param ?array $roles The roles to allow mentions for. If null, all roles will be allowed.
     * @return AllowedMentions The allowed mentions object.
     */
    public function allowRoles(?array $roles = null) {
        if($roles == null) {
            $this->data['parse'][] = 'roles';
        }
        $this->data['roles'] = $roles;
        return $this;
    }

    /**
     * Allow mentions targeting users inside the webhook.
     * @param ?array $users The users to allow mentions for. If null, all users will be allowed.
     * @return AllowedMentions The allowed mentions object.
     */
    public function allowUsers(?array $users = null) {
        if($users == null) {
            $this->data['parse'][] = 'users';
        }
        $this->data['users'] = $users;
        return $this;
    }

    /**
     * Gets the data of the allowed mentions object.
     * @return array The data of the allowed mentions object.
     * @internal
     */
    public function data() {
        return $this->data;
    }
}