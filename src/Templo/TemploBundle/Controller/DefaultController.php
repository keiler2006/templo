<?php

namespace Templo\TemploBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

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
            'mostPopular'=>$mostPopular,
            'mostCheap'=>$mostCheap
        ));
    }

}
