<?php

namespace MyApp;

require ('vendor/autoload.php');

use DateTimeImmutable;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\JwtFacade;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;

$key = InMemory::base64Encoded(
    'hiG8DlOKvtih6AxlZn5XKImZ06yu8I3mkOzaJrEuW8yAv8Jnkw330uMt8AEqQ5LB'
);

$token = (new JwtFacade())->issue(
    new Sha256(),
    $key,
    static fn (
        Builder $builder,
        DateTimeImmutable $issuedAt
    ): Builder => $builder
);

var_dump($token->claims()->all());
echo $token->toString();