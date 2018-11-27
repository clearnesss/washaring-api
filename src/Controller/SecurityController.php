<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SecurityController
{
    public function login(): JsonResponse
    {
        return new JsonResponse(['message' => 'Authentication succeed!'], Response::HTTP_OK);
    }
}