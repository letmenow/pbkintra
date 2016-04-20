<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/")
 */
class DescargaController extends Controller {  
    /**
     * @Route("/descarga", name="descargas")
     */
    public function DescargaAction()
    {
        //Filtro de accesos 
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
           return $this->render('error_login.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));    
    }
        
        return $this->render('descargas/descargas.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));
    }
}
