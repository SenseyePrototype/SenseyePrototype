<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DeveloperProfileType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description', TextareaType::class, [
                'empty_data' => '',
                'required' => false,
            ])
            ->add('salary')
            ->add('experience')
            ->add('assert', TextareaType::class, [
                'empty_data' => '',
                'required' => false,
            ])
            ->add('expect', TextareaType::class, [
                'empty_data' => '',
                'required' => false,
            ])
            ->add('published')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\DeveloperProfile'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_developerprofile';
    }


}
