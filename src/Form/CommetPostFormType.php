<?php

namespace App\Form;

use App\Entity\Comment;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommetPostFormType extends AbstractType
{
    public function commentPost(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextType::class,[
                'label'=>' '
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>Comment::class
        ]);
    }
}