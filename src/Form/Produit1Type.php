<?php

namespace App\Form;

use App\Entity\Boutique;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Produit1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('labelle',TextType::class,[
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' =>'Nom du produit'
                ]
            ])
            ->add('prix',IntegerType::class,[
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' =>'Prix'
                    ]
                ])
            ->add('tva',IntegerType::class,[
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' =>'tva'
                ]
            ])
            ->add('stockinit',IntegerType::class,[
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' =>'Stock'
                ]
            ])
            ->add('poids',TextType::class,[
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' =>'Poids'
                ]
            ])
            ->add('description',TextType::class,[
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' =>'description'
                ]
            ])
            ->add('visible',CheckboxType::class,[
                'required' => false
            ])
            ->add('imageFile',FileType::class,[
                'required' => false,
                'label' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
