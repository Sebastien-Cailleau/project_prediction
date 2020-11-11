<?php

namespace App\Controller;

use App\Service\ApiClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        $nextRound = $this->apiClient->getNextRound();
        $lastResult = $this->apiClient->getLastResult();
        $driverStandings = $this->apiClient->getDriverStandings();

        return $this->render('default/home.html.twig', [
            'nextRound' => $nextRound,
            'lastResult' => $lastResult,
            'driverStandings' => $driverStandings
        ]);
    }
}
