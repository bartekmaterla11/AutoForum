<?php

namespace App\Form;

use App\Entity\CategoryPost;
use App\Repository\CategoryPostRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryPostFormType extends AbstractType
{
    private $categoryRepository;

    public function __construct(CategoryPostRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', EntityType::class,[
                'choices' => $this->categoryRepository->findByIdCategory(),
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CategoryPost::class,
        ]);
    }
}