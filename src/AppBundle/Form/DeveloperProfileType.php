<?php

namespace AppBundle\Form;

use AppBundle\Entity\City;
use AppBundle\Entity\DeveloperProfile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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
            ->add('mainCity', EntityType::class, [
                'class' => City::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er
                        ->createQueryBuilder('city')
                        ->orderBy('city.name', 'ASC');
                },
                'choice_label' => function (City $city) {
                    return $city->getName();
                },
            ])
            ->add('published')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DeveloperProfile::class,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_developerprofile';
    }
}
