<?php

namespace App\Controller\Back;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/back/users", name="app_back_users", methods={"GET"})
     */
    public function allUsers(UserRepository $userRepository): JsonResponse
    {
        $allUsers = $userRepository->findAll();

        return $this->json($allUsers, 201, [], ['groups' => 'back:users']);
    }


    /**
     * @Route("/new", name="app_back_user_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SerializerInterface $serializer, ManagerRegistry $managerRegistry)
    {
        $jsonContent = $request->getContent();
        $user = $serializer->deserialize($jsonContent, User::class, 'json');
        $entityManager = $managerRegistry->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        return $this->json(
            $user,
            201,
            [],
            ['groups' => 'back:users']
            );
        }

}
