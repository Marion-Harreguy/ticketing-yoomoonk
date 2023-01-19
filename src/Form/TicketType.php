<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label'     => 'Prénom',
                'required'  => true,
                'attr'      => [
                    'placeholder' => 'Prénom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label'     => 'Nom',
                'required'  => true,
                'attr'      => [
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label'     => 'Email',
                'required'  => true,
                'attr'      => [
                    'placeholder' => 'Email'
                ]
            ])
            ->add('phone', TextType::class, [
                'label'     => 'Téléphone',
                'required'  => true,
                'attr'      => [
                    'placeholder' => 'Téléphone'
                ]
            ])
            ->add('adress', TextType::class, [
                'label'     => 'Adresse',
                'required'  => false,
                'attr'      => [
                    'placeholder' => 'Adresse'
                ]
            ])
            ->add('zip', TextType::class, [
                'label'     => 'Code Postal',
                'required'  => false,
                'attr'      => [
                    'placeholder' => 'Code Postal'
                ]
            ])
            ->add('city', TextType::class, [
                'label'     => 'Ville',
                'required'  => false,
                'attr'      => [
                    'placeholder' => 'Ville'
                ]
            ])
            ->add('message', TextareaType::class, [
                'label'     => 'Votre message',
                'required'  => true,
                'attr'      => [
                    'placeholder' => 'Laissez nous votre message :)'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
