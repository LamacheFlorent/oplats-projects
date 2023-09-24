<?php
    // src\Controller\ExternalApiController.php
 
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

 
class ExternalApiController extends AbstractController
{
    /**
     * take and send data
     * @param HttpClientInterface $httpClient
     * @return JsonResponse
     */
    #[Route('/api/external/getSfDoc', name: 'external_api', methods: 'GET')]
            public function getSymfonyDoc(HttpClientInterface $httpClient): JsonResponse
    {
        $response = $httpClient->request(
            'GET',
            'https://www.themealdb.com/api/json/v1/1/search.php?s='
        );
        return new JsonResponse($response->getContent(), $response->getStatusCode(), [], true);
    }
}