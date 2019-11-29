<?php

namespace App\Form;

use App\Entity\Boutique;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Produit1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('labelle')
            ->add('prix')
            ->add('tva')
            ->add('stock')
            ->add('stockinit')
            ->add('poids')
            ->add('visible')
            ->add('description')
            ->add('imageFile',FileType::class,[
                'required' => false
            ]);
        //->add('boutiques',EntityType::class,
              //  array('class' =>Boutique::class,'choice_label'=> 'nomBoutique'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
