<?php

namespace App\Controller;

use App\Entity\Question;
use App\Form\Question1Type;
use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[Route('/')]
class HomeTestController extends AbstractController
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }


    #[Route('/', name: 'app_home_test_index', methods: ['GET'])]
    public function index(QuestionRepository $questionRepository): Response
    {
        $response = $this->client->request(
            'GET',
            //'https://the-trivia-api.com/api/questions?categories=arts_and_literature,film_and_tv,food_and_drink,general_knowledge,geography,history,music,science,society_and_culture,sport_and_leisure&limit=5&difficulty=medium'        );
            'http://192.168.1.62'        );

        $content = $response->toArray();
        return $this->render('home_test/index.html.twig', [
            'questions' => $questionRepository->findAll(),
            'controller_name' => 'TestController',
            'jsonArray'=> $content
        ]);
    }

    #[Route('/new', name: 'app_home_test_new', methods: ['GET', 'POST'])]
    public function new(Request $request, QuestionRepository $questionRepository): Response
    {
        $question = new Question();
        $form = $this->createForm(Question1Type::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionRepository->save($question, true);

            return $this->redirectToRoute('app_home_test_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('home_test/new.html.twig', [
            'question' => $question,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_home_test_show', methods: ['GET'])]
    public function show(Question $question): Response
    {
        return $this->render('home_test/show.html.twig', [
            'question' => $question,
        ]);
    }

    #[Route('/{id}/back/question/edit', name: 'app_back_question_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Question $question, QuestionRepository $questionRepository): Response
    {
        $form = $this->createForm(Question1Type::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionRepository->save($question, true);

            return $this->redirectToRoute('app_home_test_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/question/edit.html.twig', [
            'question' => $question,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_home_test_delete', methods: ['POST'])]
    public function delete(Request $request, Question $question, QuestionRepository $questionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$question->getId(), $request->request->get('_token'))) {
            $questionRepository->remove($question, true);
        }

        return $this->redirectToRoute('app_home_test_index', [], Response::HTTP_SEE_OTHER);
    }
}
