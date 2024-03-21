<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('mail')
            ->add('mdp')
            ->add('statut')
            ->add('nbTentative')
            ->add('image')
            ->add('dateNaissance')
            ->add('dateInscription')
            ->add('tel')
            ->add('role')
            ->add('poids')
            ->add('taille')
            ->add('sexe')
            ->add('tfa')
            ->add('tfaSecret')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
