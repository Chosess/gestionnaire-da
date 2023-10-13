<?php

namespace App\Form;

use App\Entity\Absences;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbsencesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('debut', TextType::class, array(
                'mapped' => false,
                'attr' => array(
                    'placeholder' => 'jj/mm/aaaa'
                )))
            ->add('fin', TextType::class, array(
                'mapped' => false,
                'required' => false,
                'attr' => array(
                    'placeholder' => 'jj/mm/aaaa'
                )))
            ->add('motif')
            ->add('justif')
            ->add('document')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Absences::class,
        ]);
    }
}
