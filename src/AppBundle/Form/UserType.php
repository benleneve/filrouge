<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', 'text')
            ->add('lastName', 'text')
            ->add('login', 'text')
            ->add('password', 'text')
            ->add('birthDate', 'date',  array(
                'input'  => 'datetime',
                'widget' => 'choice',
                'format' => 'dd MM yyyy'
                ))
            ->add('email', 'text')
            ->add('address', 'text')
            ->add('postCode', 'text')
            ->add('city', 'text')
            ->add('phone', 'text')
            ->add('description', 'textarea')
            ->add('availability', 'choice', array(
                    'choices' => array(true => "Disponible", false => "Indisponible" )
                 ))
            ->add('dispoBirth', 'choice', array(
                    'choices' => array(true => "Public", false => "Privé")
                 ))
            ->add('dispoEmail', 'choice', array(
                    'choices' => array(true => "Public", false => "Privé")
                 ))
            ->add('dispoAddress', 'choice', array(
                    'choices' => array(true => "Public", false => "Privé")
                 ))
            ->add('dispoPhone', 'choice', array(
                    'choices' => array(true => "Public", false => "Privé")
                 ))
          /*  ->add('promotion', 'entity', array
                ('class' => 'AppBundle:Promotion',
                  'property' => 'name'
                ))
            ->add('school', 'entity', array
                ('class' => 'AppBundle:School',
                  'property' => 'name'
                ))*/
            ->add('image', new ImageType())
            ->add('Valider', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_user';
    }
}
