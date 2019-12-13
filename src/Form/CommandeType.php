<?php

namespace App\Form;

use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numcommande',TextType::class,[
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' =>'Numero Commande'
                ]
            ])
            ->add('dateCommande',DateTimeType::class,[
        'required' => true,
        'label' => 'date de la commande ',
        'attr' => [
            'placeholder' =>'Date de la commande '
        ]
    ])
            ->add('tht',MoneyType::class,[
        'required' => true,
        'label' => 'Montant',
        'attr' => [
            'placeholder' =>'Montant de la commande'
        ]
    ])
            ->add('livrer', ChoiceType::class, [
                'choices'  => [
                    'livré' =>  'livré',
                    'En attente' =>  'En attente',
                    'transporté' => 'transporté',
                ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
