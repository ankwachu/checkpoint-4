<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Location;
use App\Repository\LocationRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('location', EntityType::class, [
                    'class' => Location::class,
                    'choice_label' => 'name',
                    'label' => 'Ville',
                    'query_builder' => function(LocationRepository $location) {
                        return $location->createQueryBuilder('l')
                            ->orderBy('l.name', 'ASC')
                            ;
                    }
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Campus::class,
        ]);
    }
}
