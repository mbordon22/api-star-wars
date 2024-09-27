<?php

namespace App\Controller;

use App\Service\StarWarsApiService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StarWarsController extends AbstractController
{
    private $starWarsApiService;

    public function __construct(StarWarsApiService $starWarsApiService)
    {
        $this->starWarsApiService = $starWarsApiService;
    }

    /**
     * @Route("/api/star-wars/people", name="get_star_wars_people", methods={"POST"})
     */
    public function getPeople(Request $request)
    {
        $page = $request->query->get('page', 1);
        $search = $request->query->get('search', '');

        $people = $this->starWarsApiService->getPeople($page, $search);

        // Verificar si hubo un error en el servicio
        if (isset($people['error'])) {
            return new JsonResponse(
                ['message' => $people['error']],
                $people['status_code']
            );
        }

        return new JsonResponse($people, JsonResponse::HTTP_OK);
    }
}
