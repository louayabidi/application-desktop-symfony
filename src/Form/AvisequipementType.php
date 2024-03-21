<?php

namespace App\Form;

use App\Entity\Avisequipement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvisequipementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('commaeq')
            ->add('like')
            ->add('dislike')
            ->add('idus')
            ->add('ideq')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avisequipement::class,
        ]);
    }
}
