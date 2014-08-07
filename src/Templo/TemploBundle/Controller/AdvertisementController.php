<?php

namespace Templo\TemploBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Templo\TemploBundle\Entity\Piso;
use Templo\TemploBundle\Form\PisoType;
use Templo\TemploBundle\Form\LocalType;
use Templo\TemploBundle\Form\ChaletType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/user")
 */
class AdvertisementController extends Controller {

    /**
     * Muestra los enlaces para crear los distintos tipos de anuncios
     * 
     * @Route("/create-advertisement", name="user_create_advertisement")
     * @Security("has_role('ROLE_USER')")
     * @Template()
     */
    public function advertisementCreateLinksAction() {
        
         $flat_form = $this->createForm(new PisoType());
         $local_form = $this->createForm(new LocalType());
         $chalet_form = $this->createForm(new ChaletType());

        return array(
            'flat_form' => $flat_form->createView(),
            'local_form' => $local_form->createView(),
            'chalet_form' => $chalet_form->createView()
        );
    }
    
      
    /**
     * Muestra los enlaces para crear los distintos tipos de anuncios
     * 
     * @Route("/publish-flat", name="user_publish_flat")
     * @Security("has_role('ROLE_USER')")
     * @Template("TemploBundle:Advertisement:pisoWizard.html.twig")
     */
    public function publishFlatAction(Request $request) {

        $piso = new Piso();
        $form = $this->createForm(new PisoType(), $piso);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            $valid = $this->get('templo.advertisement.validator');
            
            $step = $request->request->get('step');
            $piso->setGpsAltitud(0.0);
            $piso->setGpsLongitud(0.0);
            $errors = $valid->validarPiso($piso, $step);
            if (count($errors) == 0) {
                $response['success'] = true;
                if ($request->request->has('last')) {                  
                    try { 
                        $em = $this->getDoctrine()->getEntityManager();                       
                        $em->persist($piso);
                        $em->flush();                      
                    } catch (\Exception $es) {                     
                        $response['success'] = false;
                        $response['cause'] = $es->getMessage();
                    }
                }  
            } else {               
                $response['success'] = false;
                $response['cause'] = $errors;
            }


            return new JsonResponse($response);
        }

        return array(
            'form' => $form->createView()
        );

    }

    /**
     * Muestra los enlaces para crear los distintos tipos de anuncios
     * 
     * @Route("/verify-office", name="user_new_office_ajaxaa")
     * @Security("has_role('ROLE_USER')")
     * @Template("TemploBundle:Advertisement:officeFormAjax.html.twig")
     */
    public function verifyOfficeDataAction(Request $request) {

        if ($request->isMethod('GET')) {

            $form = $this->createForm(new OficinaTypeA());


            return array(
                'form' => $form->createView()
            );
        }






        $em = $this->getDoctrine()->getManager();
        $oficina = new Oficina();

        $user = $this->container->get('security.context')->getToken()->getUser();

        $flow = $this->get('templo.form.flow.oficina'); // must match the flow's service id
        $flow->bind($oficina);

        // form of the current step
        $form = $flow->createForm();
        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);

            if ($flow->nextStep()) {
                // form for the next step
                $form = $flow->createForm();
            } else {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($oficina);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success', 'Anuncio creado exitosamente');
                return $this->redirect($this->generateUrl('user_dashboard')); // redirect when done
            }
        }
        return array(
            'form' => $form->createView(),
            'flow' => $flow,
            'entity' => $oficina
        );
    }

    public function indexAction() {
        $mostPopular = array();
        $mostCheap = array();

        for ($i = 0; $i < 4; $i++) {
            $mostPopular[] = array(
                'id' => rand(1, 3),
                'price' => rand(80000, 20000),
                'status' => 'Venta',
                'title' => 'Title: Lorem ipsum dolor ' . rand(10, 20),
                'address' => 'Address: Lorem ipsum dolor ' . rand(10, 20),
                'garage' => rand(0, 3),
                'bed' => rand(1, 5),
                'bath' => rand(1, 5),
                'sqft' => rand(50, 100)
            );

            $mostCheap[] = array(
                'id' => rand(1, 3),
                'price' => rand(80000, 20000),
                'status' => 'Venta',
                'title' => 'Title: Lorem ipsum dolor ' . rand(10, 20),
                'address' => 'Address: Lorem ipsum dolor ' . rand(10, 20),
                'garage' => rand(0, 3),
                'bed' => rand(1, 5),
                'bath' => rand(1, 5),
                'sqft' => rand(50, 100)
            );
        }


        return $this->render('TemploBundle:Default:index.html.twig', array(
                    'mostPopular' => $mostPopular,
                    'mostCheap' => $mostCheap
        ));
    }

    public function topMenuPropertiesAction() {
        $selected = array();

        for ($i = 0; $i < 4; $i++) {
            $selected[] = array(
                'id' => rand(1, 3),
                'price' => rand(80000, 20000),
                'status' => 'Venta',
                'title' => 'Title: Lorem ipsum dolor ' . rand(10, 20),
                'address' => 'Address: Lorem ipsum dolor ' . rand(10, 20),
                'garage' => rand(0, 3),
                'bed' => rand(1, 5),
                'bath' => rand(1, 5),
                'sqft' => rand(50, 100)
            );
        }

        return $this->render('TemploBundle:includes:topMenuProperties.html.twig', array(
                    'selected' => $selected
        ));
    }

}
