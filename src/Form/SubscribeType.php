<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubscribeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                "label" => "Nom :"
            ])
            ->add('lastname', TextType::class,[
                "label" => "Prenom :"
            ])
            ->add('birthday', DateType::class,[
                "label" => "Date de naissance : "
            ])

            ->add('testRadio',ChoiceType::class,array(
                "label" => "Genre : ",
                'choices'  => array(
                    'Homme' => "male",
                    'Femme' => 'female',
                ),
                'expanded' => true,
                'multiple' => false
            ))

            ->add('options',ChoiceType::class,[
                "label" => "Choix de l'option : ",
                'choices'  => array(
                    'Soir et week-end (+10€/mois) ' => 0,
                    'Coaching (+10€/mois)' => 1,
                    'Cours collectif (+10€/mois)' => 2,
                ),

            ])
        ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([

        ]);
    }


}
