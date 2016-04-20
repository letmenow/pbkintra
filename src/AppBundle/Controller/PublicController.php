<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Noticia;

/**
 * @Route("/")
 */

class PublicController extends Controller
{    
    //private $noticias;
    /**
     * @Route("/dashboard", name="home" )
    */
    public function indexAction()
    {   

        /* Recobrar los datos de Noticia */
        $noticias = $this->getDoctrine()
                ->getRepository('AppBundle:Noticia')
                ->findAll();
        return $this->render('noticia/mostrar_noticia.html.twig', array('noticias'=>$noticias)
        );
    }
    
     /**
     * @Route("/mostrar/{id}", name="ver_noticia")
     */
    public function verNoticiaAction($id)
    {   
 
        /* Recobrar los datos dependiendo de la ID de noticia */
        $noticia = $this->getDoctrine()
                ->getRepository('AppBundle:Noticia')
                ->find($id);
        return $this->render('noticia/ver_noticia.html.twig', array('noticia'=>$noticia)
        );
    }

     /**
     * @Route("/subir", name="crear_noticia" )
     */
    public function formularioAction(Request $request)
    {   
        //Filtro de accesos 
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
           return $this->render('error_login.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));    
    }
        
        $noti = new Noticia();
        $noti->setFecha(new \DateTime('now'));
        $form = $this->createFormBuilder($noti)         
            ->add('titulo', 'text')
            ->add('resumen','text')
            ->add('autor', 'text')
            ->add('contenido', 'textarea' , array(
            'attr' => array('class' => 'editor1' , 'cols' => '30', 'rows' => '10'),
             ))    
         ->add('fecha', 'date') 
         ->add('save' , 'button', array('label' => 'enviar'))
         ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
           $em = $this->getDoctrine()->getManager();
           $em->persist($noti);
           $em->flush();
           return $this->redirect($this->generateUrl('home'));
        }
        return $this->render('noticia/test_noticia.html.twig', array(
            'form' => $form->createView(),
        ));
}
}
