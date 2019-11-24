<?php

namespace VanillaGit;

class User{    
    private $client;    
    public function __construct($client)
    {
        $this->client = $client;
    }
	function authenticate($username,$password){
	    $this->client->authenticate($username, $password, \Github\Client::AUTH_HTTP_PASSWORD);
	}
	function get(){
	    try {
	        $user=$this->client->api('current_user')->show();
	        var_dump($this->client->api('current_user')->show());
	        return $this->client->api('current_user');
	    } catch (\RuntimeException $e) {
	        return false;
	    }
	}
}