<?php

namespace App\Form;

use App\Entity\Vinyl;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VinylType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('artiste')
            ->add('label')
            ->add('catNum')
            ->add('format')
            ->add('country')
            ->add('year')
            ->add('mediaCondition')
            ->add('sleeveCondition')
            ->add('quantityStock')
            ->add('regularPrice')
            ->add('reducePrice')
            ->add('cover')
            ->add('description')
            ->add('genre')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vinyl::class,
        ]);
    }
}
