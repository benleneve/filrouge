<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjectType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('startDate', 'date', array(
                'input'  => 'datetime',
                'widget' => 'choice'
            ))
            ->add('endDate', 'date', array(
                'input'  => 'datetime',
                'widget' => 'choice'
            ))
            ->add('purpose', 'text')
            ->add('description', 'textarea')
            ->add('projectManager', 'entity', array(
                'class' => 'AppBundle:Status',
                'property' => 'name'
            ))
            ->add('status', 'entity', array(
                'class' => 'AppBundle:Status',
                'property' => 'name'
            ))
            ->add('Valider', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Project'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_project';
    }
}
