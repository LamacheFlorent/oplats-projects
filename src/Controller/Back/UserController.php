<?php

namespace App\Controller\Back;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route("/back/users", name="app_back_users", methods={"GET"})
     */
    public function allUsers(UserRepository $userRepository): JsonResponse
    {
        $allUsers = $userRepository->findAll();

        return $this->json($allUsers, 200, [], ['groups' => 'back:users']);
    }

    /**
     * @Route("/back/users", name="back_users_post", methods={"POST"})
     */
    public function createUsers(Request $request, SerializerInterface $serializer, ManagerRegistry $managerRegistry)
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
