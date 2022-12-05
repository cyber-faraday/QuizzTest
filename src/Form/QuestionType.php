<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Level;
use App\Entity\Category;
use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextType::class, array(
                'constraints' => new NotBlank(),
                'label' => "Question",
            ))
            // ->add('createdAt')
            // ->add('updatedAt')
            ->add('category', EntityType::class, [
                'label' => 'Choisir la catégorie',
                'choice_label' => 'name',
                'class' => Category::class,
                'multiple' => false,
                'expanded' => false,
                'required' => true
            ])
            ->add('levels', EntityType::class, [
                'label' => 'Choisir le ou les niveaux de difficulté',
                'choice_label' => 'name',
                'class' => Level::class,
                'multiple' => true,
                'expanded' => false,
                'required' => true
            ])
            ->add('games', EntityType::class, [
                'label' => 'Choisir le ou les jeux',
                'choice_label' => 'name',
                'class' => Game::class,
                'multiple' => true,
                'expanded' => false,
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
