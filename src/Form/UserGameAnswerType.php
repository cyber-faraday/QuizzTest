<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\User;
use App\Entity\Answer;
use App\Entity\UserGameAnswer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class UserGameAnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('good', ChoiceType::class, [
                'label' => 'Status de la réponse',
                'choices' => [
                    'Fausse' => 0,
                    'Vrai' => 1,
                ]])
            ->add('delayAnswer', NumberType::class, array(
                'label' => "Délai de réponse",
            ))
            ->add('answer', EntityType::class, [
                'label' => 'Choisir la réponse',
                'choice_label' => 'content',
                'class' => Answer::class,
                'multiple' => false,
                'expanded' => false,
                'required' => true
            ])
            ->add('game', EntityType::class, [
                'label' => 'Choisir la partie',
                'choice_label' => 'name',
                'class' => Game::class,
                'multiple' => false,
                'expanded' => false,
                'required' => true
            ])
            ->add('user', EntityType::class, [
                'label' => 'Choisir le membre',
                'choice_label' => 'Pseudo',
                'class' => User::class,
                'multiple' => false,
                'expanded' => false,
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserGameAnswer::class,
        ]);
    }
}
