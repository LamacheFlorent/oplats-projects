<?php

namespace App\Controller;

use App\Entity\Review;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ReviewController extends AbstractController
{
    /**
     * Retourne tous les commentaires en JSON
     * @Route("/review", name="app_review", methods={"GET"})
     */
    public function Comment(ReviewRepository $reviewRepository): JsonResponse
    {
        $allComments = $reviewRepository->findAll();

        return $this->json($allComments, 200, [], ['groups' => 'reviews:users']);
    }
}
