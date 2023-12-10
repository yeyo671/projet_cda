<?php

namespace App\Form;

use App\Entity\Blogpost;
use App\Entity\Comment;
use App\Entity\Paint;
use Symfony\Component\Form\Extension\Core\Type\TextType; // Corrected import
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('autor', TextType::class) // TextType for a form field
            ->add('email', EmailType::class)
            ->add('content', TextareaType::class)
            ->add('isPublished', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
