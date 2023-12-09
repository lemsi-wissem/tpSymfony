<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Location;
use App\Entity\Voiture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_debut')
            ->add('date_retour')
            //->add('prix')
            //prix is calculated in the controller and not in the form
            //get all the clients from the database
                ->add('client', EntityType::class, [
                    'class' => Client::class,
                    'choice_label' => function ($client) {
                        return $client->getNom() . ' ' . $client->getPrenom();
                    },
                    'multiple' => false,
                    'expanded' => false,
                ])
            //get all the voitures from the database
                ->add('voiture', EntityType::class, [
                    'class' => Voiture::class,
                    'choice_label' => 'serie',
                    'multiple' => false,
                    'expanded' => false,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
