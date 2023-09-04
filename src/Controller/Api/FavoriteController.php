<?php

namespace App\Controller\Api;


use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class FavoriteController extends AbstractController
{
    /**
     * @Route("/api/favorites/add/{code_api}", name="app_favorite_add", methods={"GET"})
     */
    public function addFavorite(
        Request $request,
        RecipeRepository $recipeRepository,
        EntityManagerInterface $em
    ): JsonResponse {

        // Ce doc block permet d'indiquer que notre variable est de type App\Entity\User
        // Parce que, de base $this->getUser() indique retourner une variable de type UserInterface
        // L'erreur n'était qu'une erreur vscode, et ne générait pas de vraie erreur côté serveur
        /** @var App\Entity\User $user */
        $user = $this->getUser();

        if (!$user) {
            $this->json([
                'message' => 'Utilisateur non connecté. Fournir le JWT.'
            ], Response::HTTP_BAD_REQUEST);
        }

        $code_api = $request->get('code_api');

        // On va vérifier si une recette avec le code api fournit existe
        $recipe = $recipeRepository->findOneByCodeApi($code_api);

        // Si elle n'existe pas, on l'ajoute en bdd
        if (!$recipe) {
            $recipe = new Recipe();

            $recipe->setCodeApi($code_api);

            $em->persist($recipe);
            $em->flush();
        }

        $user->addFavorite($recipe);

        $em->flush();

        return $this->json([
            "La recette '$code_api' a bien été ajoutée aux favoris de l'utilisateur",
        ], 201);
    }
}
