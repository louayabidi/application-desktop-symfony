<?php

namespace App\Form;

use App\Entity\Avisp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvispType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('commap')
            ->add('star')
            ->add('fav')
            ->add('idplat')
            ->add('iduap')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avisp::class,
        ]);
    }
}
