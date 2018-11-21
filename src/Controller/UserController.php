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

        $user->setCreatedAt(new \DateTime());

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_CREATED);
    }

    public function read(int $id): Response
    {
        $user = $this->entityManager->getRepository('App:User')->find($id);

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

    public function list(): Response
    {
        return new Response('Method not implemented yet');
    }
}