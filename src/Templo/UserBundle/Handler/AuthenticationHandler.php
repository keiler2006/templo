<?php

namespace Templo\UserBundle\Handler;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;

class AuthenticationHandler implements AuthenticationSuccessHandlerInterface, AuthenticationFailureHandlerInterface {

    private $router;
    private $session;
    private $translator;
    private $security;

    public function __construct(RouterInterface $router, Session $session, Translator $translator, SecurityContext $security) {

        $this->router = $router;
        $this->session = $session;
        $this->translator = $translator;
        $this->security = $security;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token) {
       // $user = $this->$securit->getToken()->getUser();
        if ($this->session->get('_security.main.target_path')) {
            $url = $this->session->get('_security.main.target_path');
        } else {
            $url = $this->router->generate('user_dashboard');
        } // end if 
        // if AJAX login
        if ($request->isXmlHttpRequest()) {
            $array = array(
            'success' => true,
            'targetUrl' => $url,
            'error' => false); // data to return via JSON
            $response = new Response(json_encode($array));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
            // if form login 
        } else {

            return new RedirectResponse($url);
        }
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception) {
        // if AJAX login
        if ($request->isXmlHttpRequest()) {

            $array = array(
                'success' => false,
                'error' => true,
                'message' => $this->translator->trans($exception->getMessage(), array(), 'FOSUserBundle')); // data to return via JSON
            $response = new Response(json_encode($array));
            $response->headers->set('Content-Type', 'application/json');

            return $response;

            // if form login 
        } else {
            // set authentication exception to session
            $request->getSession()->set(SecurityContextInterface::AUTHENTICATION_ERROR, $exception);

            return new RedirectResponse($this->router->generate('fos_user_security_login'));
        }
    }

}
