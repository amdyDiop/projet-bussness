<?php

namespace App\Form;

use App\Entity\Boutique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BoutiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomBoutique',TextType::class,[
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' =>'Nom du de la boutique'
                ]
            ])
            ->add('ville',TextType::class,[
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' =>'Ville'
                ]
            ])
            ->add('nom',TextType::class,[
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' =>'Votre Nom '
                ]
            ])
            ->add('prenom',TextType::class,[
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' =>'Prénom'
                ]
            ])
            ->add('email',TextType::class,[
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' =>'Votre Prenom'
                ]
            ])
            ->add('password',PasswordType::class,[
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' =>'Mot de Passe'
                ]
            ])
            ->add('numeroCompte',TextType::class,[
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' =>'Numéro Compte '
                ]
            ])
            ->add('adresse',TextType::class,[
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' =>'Adresse'
                ]
            ])
            ->add('description',TextareaType::class,[
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' =>'Description de la boutique'
                ]
            ])
            ->add('imageFile',FileType::class,[
                'required' => false,
                'label' => false,
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
