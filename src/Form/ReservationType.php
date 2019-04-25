<?php

namespace App\Form;

use App\Entity\Horaire;
use App\Entity\Reservation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nbPlaces')
            ->add('horaire',EntityType::class,
                [
                    'label' => 'Horaire',
                    'class' => Horaire::class,
                    'choice_label' => function ($horaire) {
                        return $horaire;
                    },
                    'required' => true
                ])
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
