<?php

namespace App\Form;

use App\Entity\Genre;
use App\Entity\Vinyl;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
            ->add('mediaCondition', ChoiceType::class, [
                'choices' => [
                    'Excellent (Mint)' => 'mint',
                    'Presque excellent (Near mint)' => 'near mint',
                    'Très bon état (VG++)'   => 'vg++',
                    'Bon état (VG + ou VG)' => 'vg+',
                    'Etat moyen (VG- ou G)'   => 'g',
                    'Mauvais état (VG + ou VG)' => 'b',

                ],
            ])
            ->add('sleeveCondition', ChoiceType::class, [
                'choices' => [
                    'Excellent (Mint)' => 'mint',
                    'Presque excellent (Near mint)' => 'near mint',
                    'Très bon état (VG++)'   => 'vg++',
                    'Bon état (VG + ou VG)' => 'vg+',
                    'Etat moyen (VG- ou G)'   => 'g',
                    'Mauvais état (VG + ou VG)' => 'b',

                ],
            ])
            ->add('quantityStock')
            ->add('regularPrice')
            ->add('reducePrice')
            ->add('cover', FileType::class, [
                'data_class' => null,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Veuillez utilisez un format valide pour les images.',
                    ])
                ]
            ])
            ->add('description')
            ->add('genre', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'name'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vinyl::class,
        ]);
    }
}
