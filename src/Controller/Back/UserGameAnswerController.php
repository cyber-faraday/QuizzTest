<?php

namespace App\Controller\Back;

use App\Entity\UserGameAnswer;
use App\Form\UserGameAnswerType;
use App\Repository\UserGameAnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/back/user/game/answer')]
class UserGameAnswerController extends AbstractController
{
    #[Route('/', name: 'app_back_user_game_answer_index', methods: ['GET'])]
    public function index(UserGameAnswerRepository $userGameAnswerRepository): Response
    {
        return $this->render('back/user_game_answer/index.html.twig', [
            'user_game_answers' => $userGameAnswerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_back_user_game_answer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserGameAnswerRepository $userGameAnswerRepository): Response
    {
        $userGameAnswer = new UserGameAnswer();
        $form = $this->createForm(UserGameAnswerType::class, $userGameAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userGameAnswerRepository->save($userGameAnswer, true);

            return $this->redirectToRoute('app_back_user_game_answer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/user_game_answer/new.html.twig', [
            'user_game_answer' => $userGameAnswer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_user_game_answer_show', methods: ['GET'])]
    public function show(UserGameAnswer $userGameAnswer): Response
    {
        return $this->render('back/user_game_answer/show.html.twig', [
            'user_game_answer' => $userGameAnswer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_user_game_answer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserGameAnswer $userGameAnswer, UserGameAnswerRepository $userGameAnswerRepository): Response
    {
        $form = $this->createForm(UserGameAnswerType::class, $userGameAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userGameAnswerRepository->save($userGameAnswer, true);

            return $this->redirectToRoute('app_back_user_game_answer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/user_game_answer/edit.html.twig', [
            'user_game_answer' => $userGameAnswer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_user_game_answer_delete', methods: ['POST'])]
    public function delete(Request $request, UserGameAnswer $userGameAnswer, UserGameAnswerRepository $userGameAnswerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userGameAnswer->getId(), $request->request->get('_token'))) {
            $userGameAnswerRepository->remove($userGameAnswer, true);
        }

        return $this->redirectToRoute('app_back_user_game_answer_index', [], Response::HTTP_SEE_OTHER);
    }
}
