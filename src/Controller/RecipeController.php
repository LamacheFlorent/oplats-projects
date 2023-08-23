<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    /**
     * @Route("/recipe/list", name="app_recipe_list", methods={"POST"})
     */
    public function list(RecipeRepository $recipeRepository): Response
    {
        // custom method
        $recipe = $recipeRepository->findAllOrderedByTitleAscDql();

        return $this->render('recipe/list.html.twig');
    }

     /**
     * @Route("/recipe/{id}", name="app_recipe_show", requirements={"id"="\d+"})
     */
    public function show($id, RecipeRepository $recipeRepository)
    {
        $recipe = $recipeRepository->find($id);

        if ($recipe === null) {
            throw $this->createNotFoundException('recette non trouvée');
        }

        if ($recipe === null) {
            throw $this->createNotFoundException('recette non trouvée');
        }

        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe
        ]);
    }
}
