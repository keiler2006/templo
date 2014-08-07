<?php

namespace Templo\TemploBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class LocalType extends InmuebleType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        parent::buildForm($builder, $options);
        
        $builder->add('plantas', null, array(
                    'horizontal_input_wrapper_class' => 'col-sm-8',
                    'attr' => array(
                        'placeholder' => 'Plantas')
                ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Templo\TemploBundle\Entity\Local'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'local_form';
    }

}
