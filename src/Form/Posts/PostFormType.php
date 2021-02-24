<?php

namespace App\Form\Posts;

use App\Entity\Posts\CategoryPost;
use App\Entity\Posts\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class,[
                'class' => CategoryPost::class,
                'placeholder' => '-',
                'label' => 'Kategoria',
                'attr'=>['class'=>'choices_attr']
            ])
            ->add('title', TextType::class,[
                'label'=>' ',
                'attr'=>['class'=>'textType']
            ])
            ->add('content', TextareaType::class,[
                'label'=>' ',
                'attr'=>['class'=>'textarea1']
            ])
            ->add('photoFilesForPosts', CollectionType::class,[
                'entry_type' => FilePhotosPostFormType::class,
                'entry_options'=>['label'=>false],
                'prototype'	=> true,
                'allow_add'=> true,
                'label' => ' '
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
