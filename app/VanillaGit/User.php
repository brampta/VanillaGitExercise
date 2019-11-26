<?php

namespace VanillaGit;

class User{    
    private $client;    
    public function __construct($client)
    {
        $this->client = $client;
    }
	function oauth($token){
	    //for testing: $this->client->authenticate('user', 'password', \Github\Client::AUTH_HTTP_PASSWORD);
	    $this->client->authenticate($token, \Github\Client::AUTH_URL_TOKEN);
	}
	function get(){
	    try {
	        $user=$this->client->api('current_user')->show();
	        //var_dump($this->client->api('current_user')->show());
	        return $this->client->api('current_user');
	    } catch (\RuntimeException $e) {
	        return false;
	    }
	}
}