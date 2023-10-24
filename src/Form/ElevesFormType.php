<?php

namespace App\Form;

use App\Entity\Eleves;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class ElevesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('photo', FileType::class, array(
                'data_class' => null,
                'required' => false,
                'label' => 'image',
                'mapped' => false,
                'constraints' => [
                    new Image()
                ]
            ))
            ->add('civilite', ChoiceType::class, array(
                'label' => 'Choisissez plusieurs options',
                'choices' => [
                    'Mr' => 'Mr',
                    'Mme' => 'Mme',
                    'Autre' => 'Autre',
                ],
                'expanded' => true
            ))
            ->add('validation_inscription')
            ->add('date_inscription', TextType::class, array(
                'required' => false,
                'empty_data' => null,
                'mapped' => false,
                'attr' => array(
                    'placeholder' => 'jj/mm/aaaa'
                )))
            ->add('formation')
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
                'mapped' => false,
                'attr' => array(
                    'placeholder' => 'jj/mm/aaaa'
                )
            ))
            ->add('nationalite')
            ->add('etat_civil')
            ->add('enfants')
            ->add('ordinateur')
            ->add('sport')
            ->add('droit_image')
            ->add('suivi')
            ->add('educateurs_id')
            ->add('removetransports', TextType::class, array(
                'required' => false,
                'mapped' => false,
            ))
            ->add('newtransport', TextType::class, array(
                'required' => false,
                'mapped' => false
                ))
            ->add('lien_parente')
            ->add('date_fin_suivi', TextType::class, array(
                'required' => false,
                'empty_data' => null,
                'mapped' => false,
                'attr' => array(
                    'placeholder' => 'jj/mm/aaaa'
                )
            ))
            ->add('cotisations')
            ->add('cotisations_date', TextType::class, array(
                'required' => false,
                'empty_data' => null,
                'mapped' => false,
                'attr' => array(
                    'placeholder' => 'jj/mm/aaaa'
                )
            ))
            ->add('identifiant_cned')
            ->add('password_cned')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Eleves::class,
        ]);
    }
}
