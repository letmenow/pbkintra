<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/")
 */

class FrontController extends Controller
{    
   /**
   * @Route("/front" , name="front")
   */
    public function indexAction()
    {   

        return $this->render('front/inicio.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));
    }
     /**
    * @Route("/not", name="front_noticias")
    */
    public function frontAction()
    {   
        /* Recobrar los datos de Noticia */
        $noticias = $this->getDoctrine()
                ->getRepository('AppBundle:Noticia')
                ->findAll();
        return $this->render('noticia/front_mostrar.html.twig', array('noticias'=>$noticias)
        );
    }
    
    /**
     * @Route("/mostrar_front/{id}", name="detalles_noticia")
     */
    public function verNoticiaAction($id)
    {   
 
        /* Recobrar los datos dependiendo de la ID de noticia */
        $noticia = $this->getDoctrine()
                ->getRepository('AppBundle:Noticia')
                ->find($id);
        return $this->render('noticia/detalles_noticias.html.twig', array('noticia'=>$noticia)
        );
    }
    
     /**
     * @Route("/sugs", name="front_sugerencias")
     */
    public function mostrarAction()
    {   
        /* Recobrar los datos de Sugerencia */
        $sugerencias = $this->getDoctrine()
                ->getRepository('AppBundle:Sugerencia')
                ->findAll();
       
        return $this->render('sugerencia/front_sugerencias.html.twig', array('sugerencias'=>$sugerencias)
        );
    } 
    
    /**
     * @Route("/calen_front", name="front_calen")
     */
    public function calenAction()
    {
        return $this->render('calendario/front_calendario.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));
    }
    
    /**
     * @Route("/front_des", name="front_descargas")
     */
    public function descargaAction()
    {
        return $this->render('descargas/front_descarga.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));
    }
    
    /**
     * @Route("/fotos/{id}", name="fotos")
     */
    public function fotosAction($id)
    {
        $fotos = $this->getDoctrine()
                ->getRepository('AppBundle:Fotos')
                ->find($id);
        return $this->render('fotos/fotos.html.twig', array('fotos'=>$fotos)
        );
    }
    
    /**
     * @Route("/album", name="album")
     */
    public function albumAction()
    {
        return $this->render('fotos/album.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));
    }
}
