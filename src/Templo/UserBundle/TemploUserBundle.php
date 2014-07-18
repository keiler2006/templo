<?php

namespace Templo\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TemploUserBundle extends Bundle
{
      /**
     * extends FOSUserBundle
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
