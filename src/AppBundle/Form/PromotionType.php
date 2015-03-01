<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PromotionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'attr' => array('class'=>'promotionName', 'placeholder'=>'Promo')
            ))
            ->add('year', 'text', array(
                'attr' => array('class'=>'promotionYear', 'placeholder'=>'Année')
            ))
            ->add('school', 'entity', array
                ('class' => 'AppBundle:School',
                    'property' => 'name',
                    'attr' => array('class'=>'promotionSchool')
            ))
        ;
        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Promotion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_promotion';
    }
}
