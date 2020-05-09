<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',TextType::class,[
                'required' => true,
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' =>'Votre Prénom '
                ]])
            ->add('lastname',TextType::class,[
                'required' => true,
                'label' => 'Nom',
                'attr' => [
                    'placeholder' =>'Votre Nom '
                ]])
            ->add('phone',TextType::class,[
                'required' => true,
                'label' => 'Téléphone',
                'attr' => [
                    'placeholder' =>'Téléphone '
                ]])
            ->add('email',TextType::class,[
                'required' => true,
                'label' => 'Email',
                'attr' => [
                    'placeholder' =>'Votre Email '
                ]])
            ->add('message',TextareaType::class,[
                'required' => true,
                'label' => 'Méssage',
                'attr' => [
                    'placeholder' =>'Votre Méssage '
                ]])
            ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class

        ]);
    }

}


