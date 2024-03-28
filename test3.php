<?php
declare(strict_types=1);

use Lcobucci\JWT\Encoding\CannotDecodeContent;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Token\InvalidTokenStructure;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Token\UnsupportedHeaderFound;

require 'vendor/autoload.php';

$http_header = $_SERVER['HTTP_AUTHORIZATION'] ?? null;
$token = null;
if (!empty($http_header)) {
    if (preg_match('/Bearer\s(\S+)/', $http_header, $matches)) {
        $token = $matches[1];
    }
}

$parser = new Parser(new JoseEncoder());

try {
    $token_object = $parser->parse($token);
} catch (CannotDecodeContent | InvalidTokenStructure | UnsupportedHeaderFound $e) {
    echo 'Oh no, an error: ' . $e->getMessage();
}

echo $token_object->claims()->get('uid'), PHP_EOL;
print_r($token_object->claims()->get('data'));