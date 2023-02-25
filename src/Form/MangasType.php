<?php

namespace App\Form;

use App\config\Type;
use App\config\Genre;
use App\config\Statut;
use App\Entity\Auteur;
use App\Entity\Mangas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class MangasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)
            ->add('date_parution', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('nb_tomes', IntegerType::class)
            ->add('statut', ChoiceType::class, [
                'choices' => [
                    'En cours' => 0,
                    'Terminé' => 1,
                    'En pause' => 2,
                ],
            ])
            ->add('description', TextType::class)
            ->add('genre', ChoiceType::class, [
                'choices' => [
                    'Action' => 'Action',
                    'Fantastique' => 'Fantastique',
                    'Drame' => 'Drame',
                    'Surnaturel' => 'Surnaturel',
                    'Aventure' => 'Aventure',
                    'Comedie' => 'Comedie',
                    'Romance' => 'Romance',
                    'Psychologique' => 'Psychologique',
                    'Thriller' => 'Thiller',
                    'Tragédie' => 'Tragédie',
                    'Sport' => 'Sport',
                    'TrancheDeVie' => 'Tranche de vie',
                ]
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Shonen' => 'Shonen',
                    'Seinen' => 'Seinen',
                    'Josei' => 'Josei',
                    'Yuri' => 'Yuri',
                    'Shojo' => 'Shojo',
                    'Yaoi' => 'Yaoi',
                    'Kodomo' => 'Kodomo',
                ]
            ])
            ->add('auteur_id', EntityType::class, [
                'class' => Auteur::class,
                'placeholder' => 'Auteur',
                'required' => true,
                ])
            ->add('image', FileType::class, [
                'label' => 'Image (jpg/jpeg/png)',
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpg', 
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Le format n\'est pas correcte, veuillez selectionner une image valide.'
                    ])
                ]
            ])
            ->add('Soumettre', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mangas::class,
        ]);
    }
}
