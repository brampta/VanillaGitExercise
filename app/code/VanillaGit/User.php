<?php
namespace VanillaGit;

class User
{

    private $client;

    public function __construct()
    {
        $this->client = new \Github\Client();
    }

    function oauth($token)
    {
        // for testing: $this->client->authenticate('user', 'password', \Github\Client::AUTH_HTTP_PASSWORD);
        $this->client->authenticate($token, \Github\Client::AUTH_URL_TOKEN);
    }

    function get()
    {
        try {
            // this test for user validity should be revisited because it might impact performance..
            $user = $this->client->api('current_user')->show();
            return $this->client->api('current_user');
        } catch (\RuntimeException $e) {
            return false;
        }
    }
}