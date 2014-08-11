<?php

namespace Templo\TemploBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class InmuebleType extends AbstractType {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {


        $builder                
                ->add('localidad', null, array(
                    'label'=>'advertisement.form.location.label',
                   // 'horizontal_input_wrapper_class' => 'col-sm-7',
                    'attr' => array(
                        'placeholder' => 'advertisement.form.location.placeholder',                     
                        'data-bv-notempty'=>'true',
                        'data-bv-notempty-message'=>'advertisement.form.location.empty-message')
                    
                ))
                ->add('calle', null, array(
                    'label'=>'advertisement.form.street.label',                   
                    'attr' => array(
                        'placeholder' => 'advertisement.form.street.placeholder',                     
                        'data-bv-notempty'=>'true',
                        'data-bv-notempty-message'=>'advertisement.form.street.empty-message')                   
                ))
                ->add('numero', 'text', array(
                    'label'=>'advertisement.form.number.label',                  
                    'attr' => array(
                        'placeholder' => 'advertisement.form.number.placeholder',                     
                        'data-bv-integer'=>'true',
                        'data-bv-integer-message'=>'advertisement.form.number.not-number-message',
                        'data-bv-notempty'=>'true',
                        'data-bv-notempty-message'=>'advertisement.form.number.empty-message') 
                ))                
                ->add('conserje', null, array(
                    'label'=>'advertisement.form.doorman.label',
                    'required'=>false
                ))
                ->add('gps_longitud', 'hidden')
                ->add('gps_altitud', 'hidden')
                ->add('current_step', 'hidden', array(
                    'mapped'=>false
                ))                
                ->add('descripcion', null, array(
                    'label'=>'advertisement.form.description.label',                    
                    'required'=>false,
                    'attr' => array(
                        'placeholder' => 'advertisement.form.description.placeholder')
                ))                
                
                ->add('tipo', 'choice', array(
                    'label'=>'advertisement.form.type.label',
                    'required'=>true,                   
                    'empty_value' => '---',
                    'choices' => array(
                        'alquiler' => 'advertisement.form.type.options.rent', 
                        'venta' => 'advertisement.form.type.options.sale', 
                        'ambos' => 'advertisement.form.type.options.both'),
                    'attr' => array(                                                       
                        'data-bv-notempty'=>'true',
                        'data-bv-notempty-message'=>'advertisement.form.type.empty-message') 
                ))
                ->add('precio_venta', null, array(                   
                   'label'=>'advertisement.form.sale-price.label',
                   'attr' => array(
                        'placeholder' => 'advertisement.form.sale-price.placeholder',                     
                        'data-bv-numeric'=>'true',
                        'data-bv-numeric-message'=>'advertisement.form.sale-price.not-number-message',
                        'data-bv-notempty'=>'true',
                        'data-bv-notempty-message'=>'advertisement.form.sale-price.empty-message') 
                ))
                ->add('precio_alquiler', null, array(                   
                    'label'=>'advertisement.form.rent-price.label',
                    'attr' => array(
                        'placeholder' => 'advertisement.form.rent-price.placeholder',                     
                        'data-bv-numeric'=>'true',
                        'data-bv-numeric-message'=>'advertisement.form.rent-price.not-number-message',
                        'data-bv-notempty'=>'true',
                        'data-bv-notempty-message'=>'advertisement.form.rent-price.empty-message') 
                ))
                ->add('cocina', 'choice', array(
                    'label'=>'advertisement.form.kitchen.label',                  
                    'required'=>true,
                    'empty_value' => '---',
                    'choices' => array(
                        'ind' => 'advertisement.form.kitchen.options.ind', 
                        'ame' => 'advertisement.form.kitchen.options.ame'),
                    'attr' => array(                                                       
                        'data-bv-notempty'=>'true',
                        'data-bv-notempty-message'=>'advertisement.form.kitchen.empty-message')
                ))
                ->add('alarma', null, array(
                    'label'=>'advertisement.form.alarm.label',
                    'required'=>false
                ))
                ->add('garaje', null, array(
                    'label'=>'advertisement.form.garage.label',
                    'required'=>false                    
                ))
                ->add('bannos', 'text', array(
                    'label'=>'advertisement.form.bath.label',
                    'required'=>true,                   
                    'attr' => array(
                        'placeholder' => 'advertisement.form.bath.placeholder',
                        'data-bv-numeric-message'=>'advertisement.form.rent-price.not-number-message',
                        'data-bv-notempty'=>'true',
                        'data-bv-notempty-message'=>'advertisement.form.bath.empty-message',
                        'data-bv-integer'=>'true',
                        'data-bv-integer-message'=>'advertisement.form.bath.not-number-message')
                ))
                ->add('aire_acondicionado', null, array(
                    'label'=>'advertisement.form.air-cond.label',
                    'required'=>false                  
                ))
                ->add('calefaccion', null, array(
                    'label'=>'advertisement.form.heating.label',
                    'required'=>false
                )) 
                ->add('certificado_energetico', 'choice', array( 
                    'label'=>'advertisement.form.energy-certificate.label',
                    'required'=>true, 
                    'empty_value' => '---',
                    'choices' => array(
                        'A' => 'A',
                        'B' => 'B',
                        'C' => 'C',
                        'D' => 'D',
                        'E' => 'E',
                        'F' => 'F',
                        'G' => 'G'),
                    'attr' => array(                                                       
                        'data-bv-notempty'=>'true',
                        'data-bv-notempty-message'=>'advertisement.form.energy-certificate.empty-message')
                ))
                ->add('metros_utiles', 'text', array(
                    'label'=>'advertisement.form.mu.label',
                    'required'=>true,                  
                    'attr' => array(
                        'placeholder' => 'advertisement.form.mu.placeholder',
                        'data-bv-integer'=>'true',
                        'data-bv-integer-message'=>'advertisement.form.mu.not-number-message',
                        'data-bv-notempty'=>'true',
                        'data-bv-notempty-message'=>'advertisement.form.mu.empty-message')                     
                 ))
                ->add('metros_construidos', 'text', array(
                    'label'=>'advertisement.form.mc.label',
                    'required'=>true,                   
                    'attr' => array(
                        'placeholder' => 'advertisement.form.mc.placeholder',
                        'data-bv-integer'=>'true',
                        'data-bv-integer-message'=>'advertisement.form.mc.not-number-message',
                        'data-bv-notempty'=>'true',
                        'data-bv-notempty-message'=>'advertisement.form.mc.empty-message')                     
                 ))
                ->add('nivel_estado', 'choice', array( 
                    'label'=>'advertisement.form.state.label',
                    'empty_value' => '---',
                    'required'=>true, 
                    'choices' => array(
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6',
                        '7' => '7',
                        '8' => '8',
                        '9' => '9'),
                     'attr' => array(                                                       
                        'data-bv-notempty'=>'true',
                        'data-bv-notempty-message'=>'advertisement.form.state.empty-message')
                ))
                
                ->add('fotos', 'collection', array(
                    'type' => new FotoType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label' => 'Fotos'
                ))
                ;
    }

    /**
     * @return string
     */
    public function getName() {
        return 'inmueble_form';
    }

}
