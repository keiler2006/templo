<?php
namespace Templo\TemploBundle\Form;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;
use Symfony\Component\Form\FormTypeInterface;

class OficinaFlow extends FormFlow {

    /**
     * @var FormTypeInterface
     */
    protected $formType;
  

    public function setFormType(FormTypeInterface $formType) {
        $this->formType = $formType;
    }

    public function getName() {
        return 'oficina_form';
    }

    protected function loadStepsConfig() {
        return array(
            array(
                'label' => 'Localización',
                'type' => $this->formType,
            ),            
            array(
                'label' => 'Precio y tamaño',
                'type' => $this->formType,
            ),
            array(
                'label' => 'Confirmación'                             
            ),
        );
    }
}