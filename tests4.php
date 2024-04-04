<?php
require 'vendor/autoload.php';

use ElephantIO\Client;

// $url = 'http://localhost:3333';
// $url = 'http://206.189.46.68:3333';
// $url = 'wss://206.189.46.68:443';
$url = 'wss://206.189.46.68';

// $options = [
//     'context' => [
//         'ssl' => [
//             'verify_peer' => true,
//             'verify_peer_name' => true
//         ]
//     ]
// ];

$options = [
    'client' => Client::CLIENT_4X,
    'context' => [
        'ssl' => [
            'verify_peer' => true,
            'verify_peer_name' => true
        ]
    ]
];

$client = Client::create($url, $options);

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
$client->emit('chat message', $data);

$client->disconnect();

echo "Run My PHP File";