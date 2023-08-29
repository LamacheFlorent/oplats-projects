<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecipeController extends AbstractController
{
    /**
     * Retourne toutes les recettes
     * @Route("/recipe", name="app_recipe", methods={"GET"})
     */
    public function allRecipe(RecipeRepository $RecipeRepository): JsonResponse
    {
        $allRecipes = $RecipeRepository->findAll();

        return $this->json($allRecipes, 200);
    }
}
