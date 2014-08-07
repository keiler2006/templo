<?php

namespace Templo\TemploBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class PisoType extends InmuebleType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        parent::buildForm($builder, $options);
        
        $builder->add('habitaciones', null, array(
                    'label'=>'advertisement.form.room.label',
                    'required'=>true,                   
                    'attr' => array(
                        'placeholder' => 'advertisement.form.room.placeholder',
                        'data-bv-integer'=>'true',
                        'data-bv-integer-message'=>'advertisement.form.room.not-number-message',
                        'data-bv-notempty'=>'true',
                        'data-bv-notempty-message'=>'advertisement.form.room.empty-message') 
                ))
                ->add('trasteros', null, array(
                   'label'=>'advertisement.form.room.label',
                   'required'=>true,                   
                   'attr' => array(
                        'placeholder' => 'advertisement.form.lumber-room.placeholder',
                        'data-bv-integer'=>'true',
                        'data-bv-integer-message'=>'advertisement.form.lumber-room.not-number-message',
                        'data-bv-notempty'=>'true',
                        'data-bv-notempty-message'=>'advertisement.form.lumber-room.empty-message') 
                ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Templo\TemploBundle\Entity\Piso',
            'cascade_validation' => true
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'piso_form';
    }

}
