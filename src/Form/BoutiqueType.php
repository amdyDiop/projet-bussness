<?php

namespace App\Form;

use App\Entity\Boutique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BoutiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomBoutique',TextType::class,array(
                'label'=> 'Boutique'
            ))
            ->add('ville',TextType::class,array(
                'label'=> 'ville'
            ))
            ->add('nom',TextType::class,array(
                'label'=> 'nom'
            ))
            ->add('prenom',TextType::class,array(
                'label'=> 'prenom'
            ))
            ->add('email',TextType::class,array(
                'label'=> 'email'
            ))
            ->add('password',TextType::class,array(
                'label'=> 'mot de passe'
            ))
            ->add('numeroCompte',TextType::class,array(
                'label'=> 'numéro compte'
            ))
            ->add('adresse',TextType::class,array(
                'label'=> 'adresse '
            ))
            ->add('description',TextareaType::class,
                array(
                'label'=> 'déscription'
            ))
            ->add('imageFile',FileType::class,[
                'required' => false
            ])
            ->add('active',CheckboxType::class,[
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
