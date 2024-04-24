<?php
require 'vendor/autoload.php';

use ElephantIO\Client;

// $url = 'https://smartboxtest.porrapat.com:8443';
// $url = 'https://socket.slimmerwerken.app/';
$url = 'http://localhost:3000';

$client = Client::create($url);
$client->connect();

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

// emit an event to the server
$data = [generateRandomString()];
// $client->emit('chat message', $data);
$client->emit('send_erp_order_resync_event', ['client_id'=> 1]);

$client->disconnect();

echo "Run My PHP File";