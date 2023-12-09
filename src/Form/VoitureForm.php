<?php

namespace App\Form;

use App\Entity\Models;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class VoitureForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('serie', TextType::class)
            ->add('models', EntityType::class, [
                'class' => Models::class,
                'choice_label' => 'label',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('date_mise_en_marche', DateType::class)
            ->add('prix_jour', TextType::class)
        ;
    }

    public function getName()
    {
        return 'Voiture';
    }
}