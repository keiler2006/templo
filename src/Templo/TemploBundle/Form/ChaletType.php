<?php

namespace Templo\TemploBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class ChaletType extends InmuebleType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        parent::buildForm($builder, $options);
        
        $builder->add('habitaciones', null, array(
                    'horizontal_input_wrapper_class' => 'col-sm-8',
                    'attr' => array(
                        'placeholder' => 'Habitaciones'),
                    'constraints' => new NotBlank()
                ))
                ->add('trasteros', null, array(
                    'horizontal_input_wrapper_class' => 'col-sm-8',
                    'attr' => array(
                        'placeholder' => 'Trasteros')
                ))
                ->add('plantas', null, array(
                    'horizontal_input_wrapper_class' => 'col-sm-8',
                    'attr' => array(
                        'placeholder' => 'Plantas')
                ))
                 ->add('salones', null, array(
                    'horizontal_input_wrapper_class' => 'col-sm-8',
                    'attr' => array(
                        'placeholder' => 'Salones')
                ))
                 ->add('metros_parcelas', null, array(
                    'horizontal_input_wrapper_class' => 'col-sm-8',
                    'attr' => array(
                        'placeholder' => 'Metros de parcela')
                ))
                ->add('piscina_independiente', null, array(
                    'horizontal_input_wrapper_class' => 'col-sm-8'
                )) ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Templo\TemploBundle\Entity\Chalet'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'chalet_form';
    }

}
