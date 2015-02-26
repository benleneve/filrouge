<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjectSkillType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('skill', 'entity', array(
                'class' => 'AppBundle:Skill',
                'property' => 'name',
                'attr' => array('class'=>'skillName')
            ))
            ->add('active', 'choice', array(
                'choices' => array(true => "Recrutement Actif", false => "Recrutement Terminé" ),
                'attr' => array('class'=>'skillActive')
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ProjectSkill'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_projectskill';
    }
}
