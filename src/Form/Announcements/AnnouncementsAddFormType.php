<?php


namespace App\Form\Announcements;

use App\Entity\MainCategory;
use App\Entity\Offer;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AnnouncementsAddFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('category', EntityType::class,[
            'class' => MainCategory::class,
            'placeholder' => ' ',
            'label' => 'Wybierz kategorię',
            'attr'=>['class'=>'choices_attr']
        ])
        ->add('title', TextType::class,[
            'label'=>'Wpisz tytuł',
            'attr'=>['class'=>'textType']
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Offer::class,
        ]);
    }
}