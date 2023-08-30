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
     * Retourne l'email et le password d'un utilisateur en JSON
     * @Route("/api/users", name="app_api_users", methods={"POST"})
     */
    public function allUsers(UserRepository $userRepository): JsonResponse
    {
        $allUsers = $userRepository->findAll();

        return $this->json($allUsers, 200, [], ['groups' => 'api:users']);
    }

   
}
