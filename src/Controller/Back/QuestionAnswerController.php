<?php

namespace App\Controller\Back;

use App\Entity\QuestionAnswer;
use App\Form\QuestionAnswerType;
use App\Repository\QuestionAnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/back/question/answer')]
class QuestionAnswerController extends AbstractController
{
    #[Route('/', name: 'app_back_question_answer_index', methods: ['GET'])]
    public function index(QuestionAnswerRepository $questionAnswerRepository): Response
    {
        return $this->render('back/question_answer/index.html.twig', [
            'question_answers' => $questionAnswerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_back_question_answer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, QuestionAnswerRepository $questionAnswerRepository): Response
    {
        $questionAnswer = new QuestionAnswer();
        $form = $this->createForm(QuestionAnswerType::class, $questionAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionAnswerRepository->save($questionAnswer, true);

            return $this->redirectToRoute('app_back_question_answer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/question_answer/new.html.twig', [
            'question_answer' => $questionAnswer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_question_answer_show', methods: ['GET'])]
    public function show(QuestionAnswer $questionAnswer): Response
    {
        return $this->render('back/question_answer/show.html.twig', [
            'question_answer' => $questionAnswer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_question_answer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, QuestionAnswer $questionAnswer, QuestionAnswerRepository $questionAnswerRepository): Response
    {
        $form = $this->createForm(QuestionAnswerType::class, $questionAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionAnswerRepository->save($questionAnswer, true);

            return $this->redirectToRoute('app_back_question_answer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/question_answer/edit.html.twig', [
            'question_answer' => $questionAnswer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_question_answer_delete', methods: ['POST'])]
    public function delete(Request $request, QuestionAnswer $questionAnswer, QuestionAnswerRepository $questionAnswerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$questionAnswer->getId(), $request->request->get('_token'))) {
            $questionAnswerRepository->remove($questionAnswer, true);
        }

        return $this->redirectToRoute('app_back_question_answer_index', [], Response::HTTP_SEE_OTHER);
    }
}
