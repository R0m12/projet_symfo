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
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class MangasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)
            ->add('date_parution', DateType::class)
            ->add('nb_tomes', IntegerType::class)
            ->add('statut', TextType::class)
            ->add('description', TextType::class)
            ->add('genre', TextType::class)
            ->add('type', TextType::class)
            ->add('auteur_id', EntityType::class, [
                'class' => Auteur::class,
                'placeholder' => 'Auteur',
                'required' => true,
                ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mangas::class,
        ]);
    }
}
