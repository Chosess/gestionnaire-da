<?php

namespace App\Form;

use App\Entity\Entretiens;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntretiensFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', TextType::class, array(
                'required' => false,
                'empty_data' => null,
                'mapped' => false,
                'attr' => array(
                    'placeholder' => 'jj/mm/aaaa'
                )))
            ->add('commentaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entretiens::class,
        ]);
    }
}
