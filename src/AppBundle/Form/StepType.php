<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StepType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'attr' => array('class'=>'stepName')
            ))
            ->add('status', 'entity', array(
                'class' => 'AppBundle:Status',
                'property' => 'name',
                'attr' => array('class'=>'stepStatus')
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Step'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_step';
    }
}
