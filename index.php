<?php

//VanillaGIT 1 2 3 !!!


require_once __DIR__ . '/vendor/autoload.php';

$client = new \Github\Client();
$repositories = $client->api('user')->repositories('ornicar');

