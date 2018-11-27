<?php

namespace App\Security\Authenticator;

use App\Jwt\TokenGenerator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class LoginPassAuthenticator extends AbstractGuardAuthenticator
{
    private $passwordEncoder;

    /**
     * LoginPassAuthenticator constructor.
     * @param $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new JsonResponse(['message' => 'Authentication Required'], Response::HTTP_UNAUTHORIZED);
    }

    public function supports(Request $request)
    {
        return $request->getPathInfo() === '/api/login';
    }

    public function getCredentials(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        if(JSON_ERROR_NONE !== json_last_error()){
            throw new \InvalidArgumentException(json_last_error_msg());
        }

        if (!isset($data['username'], $data['password'])) {
            throw new \InvalidArgumentException('Username or password are missing!');
        }

        return [
            'username' => $data['username'],
            'password' => $data['password']
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $userProvider->loadUserByUsername($credentials['username']);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        throw $exception;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        $user = $token->getUser();
        return new JsonResponse(['token' => TokenGenerator::generate($user->getUsername())]);
    }

    public function supportsRememberMe()
    {
        // TODO: Implement supportsRememberMe() method.
    }

}