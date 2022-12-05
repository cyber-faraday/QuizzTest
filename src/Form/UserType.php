<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, array(
                'constraints' => new NotBlank(),
                'label' => "Adresse mail de l'utilisateur",
            ))
            ->add('roles', ChoiceType::class,
            [
                'choices' => [
                    'user' => 'ROLE_USER',
                    'admin' => 'ROLE_ADMIN',
                    'fr-translator' => 'ROLE_FRTRANSLATOR',
                    ],
                "multiple" => true,
                // radio buttons or checkboxes
                "expanded" => false
            ])

            ->add('password', PasswordType::class, [
                
                'mapped' => true,
                'required' => false,
               //'always_empty' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères.',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    // new Regex(
                    //     "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/",
                    //     "Votre mot de passe n'est pas assez sécurisé.veuillez recommencer"
                    // ), 
               
                ]
            ])
            
            ->add('confirmPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'required' => false,
            ])
            ->add('pseudo', TextType::class, array(
                'constraints' => new NotBlank(),
                'label' => "Pseudo",
            ));
            // ->add('totalScore');
            // ->add('createdAt')
        //     ->add('games')
        // ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
