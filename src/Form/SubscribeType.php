<?php

namespace App\Form;

use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubscribeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startdate', DateType::class,[
                "label" => "Date de début :"
            ])





            ->add('options',ChoiceType::class,[
                "label" => "Choix de l'option : ",
                "multiple"=>true,
                'choices'  => array(
                    'Soir et week-end (+10€/mois) ' => 1,
                    'Coaching (+10€/mois)' => 2,
                    'Cours collectif (+10€/mois)' => 3,
                ),

            ])



            ->add('type',ChoiceType::class,array(
                "label" => "Engagement : ",
                'expanded' => true,
                'required' => true,
                'choices'  => array(
                    'Sans engagement (40€ par mois)' => false,
                    'Avec engagement de 1an (25€ par mois)' => true,
                ),))


        ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([

        ]);
    }


}
