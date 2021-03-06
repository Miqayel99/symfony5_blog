<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('image', FileType::class, array(
                'label' => 'Category main image',
                'required' => false,
                'mapped' => false,
            ))
            ->add('category', EntityType::class, array(
                'label' => 'Category',
                'class' => Category::class,
                'choice_label' => 'title',

            ))

            ->add('title', TextType::class,array(
                'label' => 'Category title',
                'attr' => [
                    'placeholder' => 'Enter category name'
                ]
            ))
            ->add('content', TextareaType::class,array(
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
            'data_class' => Post::class,
        ]);
    }
}
