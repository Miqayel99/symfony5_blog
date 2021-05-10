<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image', FileType::class, array(
                'label' => 'Category main image',
                'required' => false,
                'mapped' => false,
            ))
            ->add('title', TextType::class,array(
                'label' => 'Category title',
                'attr' => [
                    'placeholder' => 'Enter category name'
                ]
            ))
            ->add('description', TextareaType::class,array(
                'label' => 'Category description',
                'attr' => [
                    'placeholder' => 'Enter category description'
                ]
            ))
            ->add('save', SubmitType::class,array(
                'label' => 'Submit',
                'attr' => [
                    'class' => 'btn btn-success float-left mr-2'
                ]
            ))
            ->add('delete', SubmitType::class,array(
                'label' => 'Delete',
                'attr' => [
                    'class' => 'btn btn-danger'
                ]
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
