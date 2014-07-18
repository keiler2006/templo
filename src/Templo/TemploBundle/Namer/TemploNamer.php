<?php

namespace Templo\TemploBundle\Namer;

use Vich\UploaderBundle\Naming\NamerInterface;

class TemploNamer implements NamerInterface
{
    public function name($obj, $field)
    {
        $file = $obj->$field;
        $extension = $file->guessExtension();

        return uniqid('', true).'.'.$extension;
    }
}