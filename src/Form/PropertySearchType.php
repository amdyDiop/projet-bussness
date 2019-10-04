<?php

namespace App\Form;

use App\Entity\propertySearch;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
            ->add('maxPrice',IntegerType::class,[
                'required' =>false,
                'label'  =>false,
        'attr' =>[
            'placeholder' =>'votre budget?'
        ]
    ])
                ->add('surface',IntegerType::class,[
                    'required' =>false,
                    'label'  =>false,
                    'attr' =>[
                        'placeholder' =>'surface maximale ?'
                    ]
                ]);
      /**  ->add('ville',IntegerType::class,[
        'required' =>false,
        'label'  =>false,
        'attr' =>[
            'placeholder' =>'ville ?'
        ]
    ]);**/
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => propertySearch::class,
            'method' =>'get',
            'csrf_protection' => false
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }
}
