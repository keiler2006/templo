<?php

namespace Templo\UserBundle\Listener;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Listener del evento SecurityInteractive que se utiliza para redireccionar
 * al usuario recién logueado a la portada de su ciudad
 */
class LoginListener
{
    private $contexto, $router, $userId;

    public function __construct(SecurityContext $context, Router $router)
    {
        $this->contexto = $context;
        $this->router   = $router;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $token = $event->getAuthenticationToken();
        $this->userId = $token->getUser()->getId();
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (null != $this->userId) {
           // if ($this->contexto->isGranted('ROLE_USER')) {
                $profile = $this->router->generate('fos_user_profile_show');
           
            /* } else {
                $portada = $this->router->generate('portada', array(
                    'ciudad' => $this->ciudad
                ));
            }*/

            $event->setResponse(new RedirectResponse($profile));
            $event->stopPropagation();
        }
    }
}
