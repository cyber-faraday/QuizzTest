<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\User;
use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, array(
                'constraints' => new NotBlank(),
                'label' => "Nom de la partie",
            ))
            // ->add('createdAt')
            ->add('questions', EntityType::class, [
                'label' => 'Choisir les questions',
                'choice_label' => 'content',
                'class' => Question::class,
                'multiple' => true,
                'expanded' => false,
                'required' => true
            ])
            ->add('users', EntityType::class, [
                'label' => 'Choisir le ou les menbres',
                'choice_label' => 'Pseudo', 
                'class' => User::class,
                'multiple' => true,
                'expanded' => false,
                'required' => true
            ])
        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
