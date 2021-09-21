<?php

namespace App\Form;

use App\Entity\Profile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('sex', ChoiceType::class, [
                'choices'  => [
                    'Man' => 'Man',
                    'Women' => 'Women',
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('birthday', DateType::class, [
                'attr' => [
                    'class' => 'form-control datepicker'
                ]
            ])
            ->add('phone',  TelType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('location', CountryType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Profile::class,
        ]);
    }
}
