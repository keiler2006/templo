<?php

namespace Templo\TemploBundle\Util;

use Templo\TemploBundle\Entity\Piso;

class AdvertisementValidator {

    private $validator;

    public function __construct($validator) {
        $this->validator = $validator;
    }

    public function validarPiso(Piso $piso, $step = null) {
        $errors = array();

        if (null == $step) {
            $validations = $this->validator->validate($piso);

            $messages = array();
            foreach ($validations as $e) {
                $messages[] = $e->getMessage();
            }

            if (count($validations) > 0) {
                $errors[] = array(
                    'field' => 'form',
                    'errors' => $messages
                );
            }
        } else {
            switch ($step) {
                case 1:
                    /*if (null === $office->getLocalidad() || "" == $office->getLocalidad()) {
                       
                        $errors[] = array(
                            'field' => 'localidad',
                            'errors' => array('Debe especificar la localidad')
                        );
                    }*/
                    break;
            }
        }
        return $errors;
    }

}
