<?php

namespace Ibrows\XeditableBundle\Tests\StandaloneTestBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NumberType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ibrows\XeditableBundle\Tests\StandaloneTestBundle\Entity\Number'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'number_form';
    }
}