<?php

namespace App\Controller\Back;
use App\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TestController extends AbstractController
{

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    #[Route('/back/test ', name: 'app_test')]
    public function index(Question $question): Response
    {
        $response = $this->client->request(
            'GET',
            //'https://the-trivia-api.com/api/questions?categories=arts_and_literature,film_and_tv,food_and_drink,general_knowledge,geography,history,music,science,society_and_culture,sport_and_leisure&limit=5&difficulty=medium'        );
            'http://192.168.1.62'        );

        $content = $response->toArray();
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
            'jsonArray'=> $content,
            'questions' => $question
        ]);
    }
}
