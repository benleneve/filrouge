<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;



class UserSkillType extends AbstractType
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
            ->add('level', 'choice', array(
                'choices' => array(1 => "notions", 2 => "débutant", 3 => "initié", 4 => "confirmé", 5 => "expert" ),
                'attr' => array('class'=>'skillLevel')
            ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\UserSkill'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_userskill';
    }
}
