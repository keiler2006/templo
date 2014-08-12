<?php

namespace Templo\TemploBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class FotoType extends AbstractType{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('file',null,array(
            'attr'=>array(
                'accept'=>'image/*'
            )
        ))
                ->add('main')
                ->add('name');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Templo\TemploBundle\Entity\FotoInmueble'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'foto_form';
    }

}
