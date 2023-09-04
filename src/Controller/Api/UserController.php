<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/api/users/register", name="app_user_register", methods={"POST"})
     */
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $em,
        UserRepository $userRepository
    ): JsonResponse {
        // On initialise l'utilisateur
        $user = new User();

        // On décode le contenu de notre requête qui est en JSON, 
        // ça va nous retourner un tableau associatif grâce au deuxième param à "true"
        $data = json_decode($request->getContent(), true);

        // On vérifie si il manque pas l'email ou le password
        if (!isset($data['email']) || !isset($data['password'])|| !isset($data['nickname']) || empty($data['email']) || empty($data['password'])|| empty($data['nickname'])) {
            return $this->json([
                'message' => "L'email ou le mot de passe est vide."
            ], Response::HTTP_BAD_REQUEST);
        }

        // On récupère l'email, nickname et le password présents dans ce tableau
        $email = $data['email'];
        $password = $data['password'];
        $nickname = $data['nickname'];


        // On vérifie si l'utilisateur n'existe pas déjà
        if ($userRepository->findOneByEmail($email)) {
            return $this->json([
                'message' => "L'email est déjà utilisé"
            ], Response::HTTP_CONFLICT);
        }

        // On hash le password
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $password
        );

        // On défini les propriétés email et password sur l'utilisateur
        $user->setEmail($email);
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_USER']);
        $user->setNickname($nickname);

        // On l'ajoute à la bdd
        $em->persist($user);
        $em->flush();

        return $this->json($user, 200, [], ['groups' => 'api:users']);
    }

    /**
     * @Route("/api/users/me/favorites", name="app_user_favorites", methods={"GET"})
     */
    public function getUserFavorites(): JsonResponse
    {

        /** @var App\Entity\User $user */
        $user = $this->getUser();

        return $this->json($user->getFavorites(), 200, [], ['groups' => 'api:recipe:read']);
    }


    /**
     * @Route("/api/users", name="app_user", methods={"POST"})
     */
    public function allUsers(UserRepository $userRepository): JsonResponse
    {
        $allUsers = $userRepository->findAll();

        return $this->json($allUsers, 200, [], ['groups' => 'api:users']);
    }
}
