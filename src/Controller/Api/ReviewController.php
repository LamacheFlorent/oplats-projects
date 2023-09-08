<?php

namespace App\Controller\Api;

use App\Entity\Recipe;
use App\Entity\Review;
use App\Repository\RecipeRepository;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class ReviewController extends AbstractController
{
    /**
     * @Route("/api/reviews/add", name="app_review_add", methods={"POST"})
     */
    public function addReview(
        Request $request,
        SerializerInterface $serializer,
        EntityManagerInterface $em,
        RecipeRepository $recipeRepository
    ): JsonResponse {

        // On récupère l'utiliseur courant grâce au JWT fourni dans la requête, dans le header Authorization
        // attention ce header doit avoir le format : `Bearer {valeur du token}`
        $user = $this->getUser();

        // Si on n'a pas d'user, on renvoit une erreur
        // impossible d'ajouter une review sans utilisateur qui la publie ..
        if (!$user) {
            $this->json([
                'message' => 'Utilisateur non connecté. Fournir le JWT.'
            ], Response::HTTP_BAD_REQUEST);
        }

        // On récupère le contenu de la requête
        $jsonContent = $request->getContent();
        // On décode pour pouvoir récupérer les valeurs au format tableau associatif PHP
        $data = json_decode($jsonContent, true);

        // Récupérer une recipe qui a le code_api $data['code_api'];
        // Si n'existe pas, la créer.
        if (!isset($data['code_api']) || empty($data['code_api'])) {
            return $this->json([
                'message' => 'La propriété code_api est manquante.'
            ], Response::HTTP_BAD_REQUEST);
        }

        // On va vérifier si une recette avec le code api fournit existe
        $recipe = $recipeRepository->findOneByCodeApi($data['code_api']);

        // Si elle n'existe pas, on l'ajoute en bdd
        if (!$recipe) {
            $recipe = new Recipe();

            $recipe->setCodeApi($data['code_api']);

            $em->persist($recipe);
            $em->flush();
        }

        // Optionel: vérifier si l'utilisateur n'a pas déjà fait une review de cette recette
        // si c'est le cas, ne pas autoriser l'ajout d'une nouvelle review, donc retourner une réponse json avec le message
        // "vous avez déjà review cette recette"

        // Récupérer les données de la review, devront être envoyé comme ça :
        /*
        {
            "comment": "mon comment",
            "note": 5,
            "code_api": 642129
        }
        */
        // Ça va automatiquement nous créer un objet Review, contenant notre comentaire et notre note
        $newReview = $serializer->deserialize($jsonContent, Review::class, 'json');

        // On défini les relations, avec la recette et l'utilisateur
        // (une review appartient à un utilisateur, et à une recette)
        $newReview->setRecipe($recipe);
        $newReview->setUser($user);

        // On sauvegarde en bdd
        $em->persist($newReview);
        $em->flush();

        // On renvoit une réponse 201 (pour http created)
        return $this->json($newReview, Response::HTTP_CREATED, [], ['groups' => 'api:review']);
    }


    /**
     * @Route("/api/reviews/{id}", name="app_reviews_recipe", methods={"GET"})
     */
    public function showReview(int $id, ReviewRepository $reviewRepository): JsonResponse
    {

        $review = $reviewRepository->find($id);

        if (!$review){
            throw $this->createNotFoundException(('comment not found'));
        }

        $data =[
            'comment'=>$review->getComment(),
            'user'=>$review->getUser(),
            'rate'=>$review->getNote()
        ];

        return $this->json($review, 200, [], ['groups' => 'api:review']);

    }
}
