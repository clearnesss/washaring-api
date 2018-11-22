<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController
{
    private $serializer;

    private $entityManager;

    private $formFactory;

    public function __construct(SerializerInterface $serializer, EntityManagerInterface $entityManager, FormFactoryInterface $formFactory)
    {
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
    }

    public function create(Request $request): Response
    {
        $rawData = $request->getContent();
        if (empty($rawData)) {
            return new Response('', Response::HTTP_BAD_REQUEST);
        }

        $data = $this->serializer->deserialize($rawData, 'array', 'json');

        $user = new User;
        $form = $this->formFactory->create(UserType::class, $user);
        $form->submit($data);
        $user->setCreatedAt(new \DateTime());

        // @TODO Implement validator
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_CREATED);
    }

    public function read(int $id): Response
    {
        $user = $this->entityManager->getRepository('App:User')->find($id);
        if (!$user) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $data = $this->serializer->serialize($user, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function update(Request $request, int $id): Response
    {
        $user = $this->entityManager->getRepository('App:User')->find($id);

        if (empty($user)) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $rawData = $request->getContent();
        $data = $this->serializer->deserialize($rawData, 'array', 'json');

        $form = $this->formFactory->create(UserType::class, $user);
        $form->submit($data, false);

        $this->entityManager->merge($user);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    public function delete(int $id): Response
    {

        $user = $this->entityManager->getRepository('App:User')->find($id);

        if (!$user) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($user);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    public function list(): Response
    {

        $users = $this->entityManager->getRepository('App:User')->findAll();
        $data = $this->serializer->serialize($users, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function deleteAll(): Response
    {
        $qb = $this->entityManager->createQueryBuilder();
        $query = $qb->delete()->from('App:User', 'u')->getQuery();
        $query->getResult(); // Return affected rows

        return new Response(Response::HTTP_NO_CONTENT);
    }
}