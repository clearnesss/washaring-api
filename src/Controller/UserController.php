<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\User\CreateUserRequestDTO;
use App\DTO\User\UpdateUserRequestDTO;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class UserController extends AbstractController
{
    private $entityManager;

    private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function create(Request $request): Response
    {
        $createUserRequestDTO = new CreateUserRequestDTO();
        $this->get('serializer')->deserialize($request->getContent(), CreateUserRequestDTO::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $createUserRequestDTO,
            AbstractNormalizer::ALLOW_EXTRA_ATTRIBUTES => false
        ]);

        $user = $createUserRequestDTO->transform();

        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            $user->getPassword()
        ));

        $this->getDoctrine()->getManager()->persist($user);
        $this->getDoctrine()->getManager()->flush();

        return new Response('', Response::HTTP_CREATED);
    }

    public function read(int $id): Response
    {
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($id);
        if (!$user) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }
        $data = $this->get('serializer')->serialize($user, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function update(Request $request, int $id): Response
    {
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($id);
        if (empty($user)) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $updateUserRequestDTO = new UpdateUserRequestDTO();
        $this->get('serializer')->deserialize($request->getContent(), UpdateUserRequestDTO::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $updateUserRequestDTO,
            AbstractNormalizer::ALLOW_EXTRA_ATTRIBUTES => false
        ]);

        if (null !== $updateUserRequestDTO->getPassword()) {
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $user->getPassword()
            ));
        }
        $updateUserRequestDTO->hydrate($user);
        $this->getDoctrine()->getManager()->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    public function delete(int $id): Response
    {
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($id);

        if (!$user) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $this->getDoctrine()->getManager()->remove($user);
        $this->getDoctrine()->getManager()->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    public function list(): Response
    {
        $users = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();
        $data = $this->get('serializer')->serialize($users, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function deleteAll(): Response
    {
        $qb = $this->entityManager->createQueryBuilder();
        $query = $qb->delete()->from(User::class, 'u')->getQuery();
        $query->getResult(); // Return affected rows

        return new Response(Response::HTTP_NO_CONTENT);
    }
}