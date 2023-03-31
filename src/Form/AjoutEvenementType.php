<?php

namespace App\Form;

use App\Entity\AjoutEvenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AjoutEvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label'=> false,
                'constraints' =>[
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide'
                    ])
                ],
                'attr'=>[
                   'class' => 'form-control mb-3',
                   'placeholder' => 'Titre',
                ],
            ])
            ->add('image', FileType::class, [
                'label' => false,
                'data_class'=> null,
                'attr' => [
                    'class'=> 'form-control mb-3',
                ],
                
            ])
            ->add('description', TextType::class, [
                'label'=> false,
                'constraints' =>[
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide'
                    ])
                ],
                'attr'=>[
                   'class' => 'form-control mb-3',
                   'placeholder' => 'Description',
                ],
            ])
            ->add('prix', TextType::class, [
                'label'=> false,
                'constraints' =>[
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide'
                    ])
                ],
                'attr'=>[
                   'class' => 'form-control mb-3',
                   'placeholder' => 'Prix',
                ],
            ])
            ->add('ville', TextType::class, [
                'label'=> false,
                'constraints' =>[
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide'
                    ])
                ],
                'attr'=>[
                   'class' => 'form-control mb-3',
                   'placeholder' => 'Ville',
                ],
            ])
            ->add('date', TextType::class, [
                'label'=> false,
                'constraints' =>[
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide'
                    ])
                ],
                'attr'=>[
                   'class' => 'form-control mb-3',
                   'placeholder' => 'Date',
                ],
            ])
            ->add('createdAt', DateType::class, [
                'label'=> false,
                'format' => 'dd MM yyyy',
              
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AjoutEvenement::class,
        ]);
    }
}
