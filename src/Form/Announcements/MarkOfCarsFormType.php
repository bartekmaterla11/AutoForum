<?php


namespace App\Form\Announcements;

use App\Entity\MarkOfCars;
use App\Entity\Template;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarkOfCarsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', EntityType::class,[
                'class' => MarkOfCars::class,
                'placeholder' => ' ',
                'label' => 'Wybierz markę',
                'attr'=>['class'=>'choices_attr']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MarkOfCars::class,
        ]);
    }
}