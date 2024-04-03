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

// eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1aWQiOiJteS1zbWFydGJveCIsImRhdGEiOlsiZGF0YTEiLCJkYXRhMiJdLCJleHAiOjE3MTIxMjAzNDcuMDE3Njk2fQ.hFXpw2f83VyAufMJAePqk_gJd--2mBqpaAVCCGSokgc
$s_random_bytes = '12345678901234567890123456789012';
$signingKey   = InMemory::plainText($s_random_bytes);

$now   = new DateTimeImmutable();

$token = $tokenBuilder
    ->withClaim('uid', 'my-smartbox')
    ->withClaim('data', ['data1', 'data2'])
    ->expiresAt($now->modify('+5 minutes'))
    ->getToken($algorithm, $signingKey);

echo $token->claims()->get('uid'), PHP_EOL; // will print "1"

echo $token->toString(), PHP_EOL; // The string representation of the object is a JWT string
