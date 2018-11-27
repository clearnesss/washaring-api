<?php

namespace App\Jwt;


use Emarref\Jwt\Algorithm\Hs256;
use Emarref\Jwt\Token;
use Emarref\Jwt\Claim;
use Emarref\Jwt\Jwt;
use Emarref\Jwt\Encryption\Factory;

class TokenGenerator
{
    public static function generate(string $subject) : string
    {
        $token = new Token();
        $token->addClaim(new Claim\IssuedAt(new \DateTime('now')));
        $token->addClaim(new Claim\Expiration(new \DateTime('30 minutes')));
        $token->addClaim(new Claim\Subject($subject));

        $jwt = new Jwt();

        $algorithm = new Hs256('passphrase');
        $encryption = Factory::create($algorithm);

        return $jwt->serialize($token, $encryption);
    }
}