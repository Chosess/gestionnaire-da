<?php

namespace App\Form;

use App\Entity\Eleves;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ElevesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('photo', FileType::class)
            ->add('civilite')
            ->add('validation_inscription')
            ->add('date_inscription', TextType::class, array(
                'required' => false,
                'empty_data' => null,
                'attr' => array(
                    'placeholder' => 'mm/dd/yyyy'
                )))
            ->add('formation')
            ->add('niveau_formation')
            ->add('annee_formation')
            ->add('prescripteur')
            ->add('conseiller')
            ->add('adresse')
            ->add('code_postal')
            ->add('ville')
            ->add('email')
            ->add('portable')
            ->add('fixe')
            ->add('nom_urgence')
            ->add('prenom_urgence')
            ->add('telephone_urgence')
            ->add('lieu_naissance')
            ->add('date_naissance', TextType::class, array(
                'required' => false,
                'empty_data' => null,
                'attr' => array(
                    'placeholder' => 'mm/dd/yyyy'
                )))
            ->add('nationalite')
            ->add('etat_civil')
            ->add('enfants')
            ->add('ordinateur')
            ->add('sport')
            ->add('droit_image')
            ->add('suivi')
            ->add('educateurs_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Eleves::class,
        ]);
    }
}
