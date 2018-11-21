<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController
{
    private $serializer;

    private $entityManager;

    public function __construct(SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
    }

    public function create(Request $request): Response
    {

        $data = $request->getContent();
        $user = $this->serializer->deserialize($data, 'App\Entity\User::class', 'json');

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_CREATED);
    }

    public function read(): Response
    {
        $user = new User();
        $user
            ->setFirstName('Julien')
            ->setLastName('LECARPENTIER')
            ->setEmail('lecarpentier.julien@gmail.com')
            ->setPhone('++33123456789')
            ->setPassword('password');

        $data = $this->serializer->serialize($user, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function update(): Response
    {
        return new Response('Method not implemented yet');
    }

    public function delete(): Response
    {
        return new Response('Method not implemented yet');
    }
}