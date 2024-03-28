<?php
declare(strict_types=1);

use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Token\Builder;

require 'vendor/autoload.php';

$tokenBuilder = (new Builder(new JoseEncoder(), ChainedFormatter::default()));
$algorithm    = new Sha256();
$signingKey   = InMemory::plainText(random_bytes(32));

$token = $tokenBuilder
    ->withClaim('uid', 'my-smartbox')
    ->getToken($algorithm, $signingKey);

echo $token->claims()->get('uid'), PHP_EOL; // will print "1"

echo $token->toString(), PHP_EOL; // The string representation of the object is a JWT string
