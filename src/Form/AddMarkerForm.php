<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Location;

class AddMarkerForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address', TextType::class)
            ->add('markerColor', ChoiceType::class, array('choices' => array(
                'Red' => 'red',
                'Yellow' => 'yellow',
                'Blue' => 'blue',
                'Green' => 'green',
                'Orange' => 'orange',
                'Pink' => 'pink',
                'Purple' => 'purple'
            )))
            ->add('markerType', ChoiceType::class, array('choices' => array(
                'Dot' => 'dot',
                'Push Pin' => 'pushpin',
                'Caution' => 'caution',
                'Flag' => 'flag',
                'Info' => 'info'
            )))
            ->add('info', TextareaType::class)
            ->add('save', SubmitType::class, array('label' => 'Get Lat Long'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => Location::class));
    }
}
