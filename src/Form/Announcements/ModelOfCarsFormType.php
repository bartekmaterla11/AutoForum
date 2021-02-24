<?php


namespace App\Form\Announcements;

use App\Entity\ModelOfCars;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModelOfCarsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', EntityType::class,[
                'class' => ModelOfCars::class,
                'placeholder' => ' ',
                'label' => 'Wybierz model',
                'attr'=>['class'=>'choices_attr']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ModelOfCars::class,
        ]);
    }
}