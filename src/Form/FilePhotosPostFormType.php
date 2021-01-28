<?php

namespace App\Form;

use App\Entity\PhotoFilesForPosts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class FilePhotosPostFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('filename', FileType::class,[
                'label'=>' ',
                'constraints' => [
                    new File([
                        'maxSize'=>'5M',
                        'mimeTypes'=>[
                            'image/*'
                        ],
                        'mimeTypesMessage'=>'Obsługiwany format pliku musi byc obrazem'
                    ])
            ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PhotoFilesForPosts::class,
        ]);
    }
}