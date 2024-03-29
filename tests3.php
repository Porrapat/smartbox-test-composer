<?php
require 'vendor/autoload.php';

use ElephantIO\Client;

$url = 'http://localhost:3333';

// if client option is omitted then it will use latest client available,
// aka. version 4.x
$options = ['client' => Client::CLIENT_4X];

$client = Client::create($url, $options);
$client->connect();
// $client->of('/'); // can be omitted if connecting to default namespace

// emit an event to the server
$data = ['my php message'];
$client->emit('chat message', $data);

$client->disconnect();