<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('usernameCanonical', HiddenType::class)
            ->add('email')
            ->add('emailCanonical', HiddenType::class)
            ->add('enabled')
            ->add('password', HiddenType::class)
            ->add('lastLogin')
            ->add('roles')
            ->add('numeroCompte',TextType::class,[
                'required' => false,
            ])
            ->add('nomBoutique',TextType::class,[
                'required' => false,
            ])
            ->add('prenom')
            ->add('nom')
            ->add('addresse')
            ->add('ville')
            ->add('description',TextType::class,[
                'required' => false,
            ])
            ->add('telephone')
            ->add('active')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
