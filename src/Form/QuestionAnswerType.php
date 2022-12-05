<?php

namespace App\Form;

use App\Entity\Answer;
use App\Entity\Question;
use App\Entity\QuestionAnswer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class QuestionAnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isGood', ChoiceType::class, [
                'label' => 'Status de la réponse',
                'choices' => [
                    'Fausse' => 0,
                    'Vrai' => 1,
                ]])
            ->add('answer', EntityType::class, [
                'label' => 'Choisir la réponse',
                'choice_label' => 'content',
                'class' => Answer::class,
                'multiple' => true,
                'expanded' => false,
                'required' => true
            ])
            ->add('question', EntityType::class, [
                'label' => 'Choisir la question',
                'choice_label' => 'content',
                'class' => Question::class,
                'multiple' => false,
                'expanded' => false,
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => QuestionAnswer::class,
        ]);
    }
}
