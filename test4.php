<?php
declare(strict_types=1);

use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Validation\Constraint\RelatedTo;
use Lcobucci\JWT\Validation\RequiredConstraintsViolated;
use Lcobucci\JWT\Validation\Validator;

require 'vendor/autoload.php';

$parser = new Parser(new JoseEncoder());

$token = $parser->parse('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1aWQiOjU1NX0.muyhWVg2FlSpepn97naFdDjJNxO-Qj97MrWjo4LMAxw');

$validator = new Validator();

try {
    $validator->assert($token, new RelatedTo('555')); // doesn't throw an exception
    // $validator->assert($token, new RelatedTo('1234567890'));
} catch (RequiredConstraintsViolated $e) {
    // list of constraints violation exceptions:
    var_dump($e->violations());
}