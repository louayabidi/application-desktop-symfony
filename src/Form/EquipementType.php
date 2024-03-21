<?php

namespace App\Form;

use App\Entity\Equipement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomeq')
            ->add('desceq')
            ->add('doceq')
            ->add('imageeq')
            ->add('categeq')
            ->add('noteeq')
            ->add('marqueeq')
            ->add('matriculeeq')
            ->add('datepremainte')
            ->add('datepromainte')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipement::class,
        ]);
    }
}
