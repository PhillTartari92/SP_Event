<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('nom', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control mb-3 mb-2',
                    'placeholder' => 'Entrez votre Nom'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Taper votre nom.',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z\s]*$/',
                        'message' => 'Le nom ne doit contenir que des lettres.'
                    ])
                ],
            ])
            ->add('prenom', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control mb-3 mb-2',
                    'placeholder' => 'Entrez votre Prénom'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Taper votre prenom.',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z\s]*$/',
                        'message' => 'Le prénom ne doit contenir que des lettres.'
                    ])
                ],
            ])
            ->add('email', EmailType::class, [
                'label'=> false,
                'attr' => [
                    'class' => 'form-control mb-3 mb-2',
                    'placeholder' => 'Entrez votre Email'
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'label' =>false,
                'attr' => ['autocomplete' => 'new-password', 
                'class' => 'form-control mb-3 mb-2',
                'placeholder' => 'Entrez votre Mot de passe'
            ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('telephone', TelType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control mb-3 mb-2',
                    'placeholder' => 'Entrez votre Téléphone'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Taper votre numero.',
                    ]),
                    new Regex([
                        'pattern' => '/^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/',
                        'message' => 'Le format du numéro de téléphone est incorrect.'
                    ])
                ],
            ])
            ->add('adresse', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control mb-3 mb-2',
                    'placeholder' => 'Entrez votre Adresse'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Taper votre adresse.',
                    ]),
                    new Regex([
                        'pattern' => '/^[0-9]{1,4}( ?[a-zA-Z]+)+$/',
                        'message' => 'Veuillez saisir une adresse valide.'
                    ])
                ],
            ])
            ->add('ville', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control mb-3 mb-2',
                    'placeholder' => 'Entrez votre Ville'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Taper votre ville.',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/',
                        'message' => 'Veuillez saisir une ville valide.'
                    ])
                ],
            ])
            ->add('codePostal', NumberType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control mb-3 mb-2',
                    'placeholder' => 'Entrez votre Code postal'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Taper votre code postal.',
                    ]),
                    new Regex([
                        'pattern' => '/^[0-9]{5}$/',
                        'message' => 'Veuillez saisir un code postal valide.'
                    ])
                ],
            ])
            // ->add('createdAt', DateType::class, [
            //     'label' => false,
            //     'format'=>('dd/MM/yyyy')
            //     // 'constraints' => [
            //     // ],
            // ])
            // ->add('updatedAt', DateType::class, [
            //     'label' => false,
            //     // 'constraints' => [

            //     // ],
            // ])
            ->add('agreeTerms', CheckboxType::class, [
                'label'=> 'Accépter les conditions',
                'mapped' => false,
                'attr' => [
                    'class' => 'm-2',
                ],
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accépter les thermes.',
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label'=> 'Valider',
                'attr' => [
                    'class' => 'btn btn-primary mt-3 ',
                ],
            ]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
