<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

$client = new \Github\Client();
$client->authenticate('brampta', 'happatata9!!9', Github\Client::AUTH_HTTP_PASSWORD);
var_dump(get_class($client->api('current_user')));
$repositories = $client->api('current_user')->repositories('brampta','owner','asc');
echo "<pre>".print_r($repositories,true)."</pre>";

