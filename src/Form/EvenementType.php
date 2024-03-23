<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomEve')
            ->add('dateDeve')
            ->add('dateFeve')
            ->add('nbrMax')
            ->add('adresseEve')
            ->add('imageEve', FileType::class, [
                'label' => 'Image de l\'événement',
                'mapped' => false, // Ne pas mapper ce champ à une propriété de l'entité
                'required' => false, // Le champ n'est pas obligatoire
            ])
        ; 
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
