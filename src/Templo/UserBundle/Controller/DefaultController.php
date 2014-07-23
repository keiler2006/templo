<?php

namespace Templo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    
    public function dashboardAction(Request $request) {        
        $em = $this->getDoctrine()->getManager();
       
        $usuario = $this->get('security.context')->getToken()->getUser(); 

        return $this->render('TemploUserBundle::dashboard.html.twig', array(
                    'usuario' => $usuario                    
        ));
    }
    
     public function userSettingAction(Request $request) {        
        $em = $this->getDoctrine()->getManager();
       
        $usuario = $this->get('security.context')->getToken()->getUser(); 

        return $this->render('TemploUserBundle::settings.html.twig', array(
                    'usuario' => $usuario                    
        ));
    }
    
    
    public function profileAction(Request $request) {        
        $em = $this->getDoctrine()->getManager();

        $usuario = $this->get('security.context')->getToken()->getUser();
       
       
        if ($formulario->isValid()) {
            // Si el usuario no ha cambiado el password, su valor es null después
            // de hacer el ->bindRequest(), por lo que hay que recuperar el valor original

            if (null == $usuario->getPassword()) {
                $usuario->setPassword($passwordOriginal);
            }
            // Si el usuario ha cambiado su password, hay que codificarlo antes de guardarlo
            else {
                $encoder = $this->get('security.encoder_factory')->getEncoder($usuario);
                $passwordCodificado = $encoder->encodePassword(
                        $usuario->getPassword(), $usuario->getSalt()
                );
                $usuario->setPassword($passwordCodificado);
            }

            $em->persist($usuario);
            $em->flush();

            $this->get('session')->getFlashBag()->add('info', 'Los datos de tu perfil se han actualizado correctamente'
            );

            return $this->redirect($this->generateUrl('usuario_perfil'));
        }

        return $this->render('UsuarioBundle:Default:perfil.html.twig', array(
                    'usuario' => $usuario,
                    'formulario' => $formulario->createView()
        ));
    }

}
