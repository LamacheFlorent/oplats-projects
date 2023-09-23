<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiRecipeController extends AbstractController
{
    /**
     * @Route("/api/recipes", name="api_recipes_list", methods={"GET"})
     */
    public function list()
    {
        $recipes = [
            // Données de recettes ici
        ];

        // Vous pouvez récupérer les données depuis la base de données ici

        return new JsonResponse($recipes);
    }
}