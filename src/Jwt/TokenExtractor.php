<?php

namespace App\Jwt;

use Emarref\Jwt\Algorithm\Hs256;
use Emarref\Jwt\Claim\Subject;
use Emarref\Jwt\Encryption\Factory;
use Emarref\Jwt\Jwt;
use Emarref\Jwt\Token;
use Emarref\Jwt\Verification\Context;
use Symfony\Component\HttpFoundation\Request;

class TokenExtractor
{
    public function extractFromRequest(Request $request) : Token
    {
        $authorization = $request->headers->get('Authorization', '');

        if(preg_match('/^Bearer (?P<token>[^ ]+)$/', $authorization, $matches)){

            $jwt = new Jwt();
            $token = $jwt->deserialize($matches['token']);

            $algorithm = new Hs256('passphrase');
            $encryption = Factory::create($algorithm);

            $context = new Context($encryption);
            $context->setSubject($token->getPayload()->findClaimByName(Subject::NAME)->getValue());
            $jwt->verify($token, $context);

            return $token;
        }
        throw new \InvalidArgumentException('Token missing!');
    }
}