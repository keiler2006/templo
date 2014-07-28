<?php

namespace Templo\TemploBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class OficinaType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

       
        switch ($options['flow_step']) {
            case 1:
                $builder->add('localidad', null, array(
                            'horizontal_input_wrapper_class' => 'col-lg-2',
                            'constraints' => new NotBlank()
                        ))
                        ->add('calle', null, array(
                            'horizontal_input_wrapper_class' => 'col-lg-2',
                            'constraints' => new NotBlank()
                        ))
                        ->add('numero', null, array(
                            'horizontal_input_wrapper_class' => 'col-lg-2',
                            'constraints' => new NotBlank()
                        ))
                        ->add('urbanizacion', null, array(
                            'horizontal_input_wrapper_class' => 'col-lg-2',
                            'constraints' => new NotBlank()
                        ))
                        ->add('piso', null, array(
                            'horizontal_input_wrapper_class' => 'col-lg-2',
                            'constraints' => new NotBlank()
                ));
                break;
            case 2:
                $builder->add('precio', null, array(
                    'horizontal_input_wrapper_class' => 'col-lg-2',
                    'constraints' => new NotBlank()
                ));
                break;
        }
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Templo\TemploBundle\Entity\Oficina'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'oficina_form';
    }

}
