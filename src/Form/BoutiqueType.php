<?php

namespace App\Form;

use App\Entity\Boutique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BoutiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomBoutique')
            ->add('ville')
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('password')
            ->add('numeroCompte')
            ->add('imageFile',FileType::class,[
                'required' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Boutique::class,
        ]);
    }
}
