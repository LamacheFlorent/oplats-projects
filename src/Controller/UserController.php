<?php

namespace App\Controller;

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
     * @Route("/", name="app_api_users", methods={"GET"})
     */
    public function allUsers(UserRepository $userRepository): JsonResponse
    {
        $allUsers = $userRepository->findAll();

        return $this->json($allUsers, 200, [], ['groups' => 'api:users']);
    }

    /**
     * @Route("/api/users", name="api_users_post", methods={"POST"})
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
            ['groups' => 'api:users']
            );
        }
}
