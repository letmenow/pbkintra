<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Evento;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * @Route("/")
 */
class CalendarioController extends Controller
{    
    
    /**
     * @Route("/calendario", name="calendario")
     */
    public function CalendarioAction()
    {
        return $this->render('calendario/calendario.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));
    }
    /**
     * @Route("/calen", name="up_calendario" , options={"expose"=true})
     */
    public function UpAction()
    {   
        /* Recobrar los eventos en formato json */
        $response = new JsonResponse();
        $repositorio= $this->getDoctrine()->getRepository('AppBundle:Evento');
        $eventos = $repositorio->findAll();
        if(!($eventos))
        {
            $data[] = array('id' => 0 , 'rut' => '0',  'razonEvento' => 'error no se encuentran eventos');
        }
        foreach ($eventos as $evento){
            $data[] = array(
                'id' => $evento->getId(),
                'fechaInicio' => $evento->getFechaInicio()->format("Y-m-d"),
                'fechaTermino' => $evento->getFechaTermino()->format("Y-m-d"),
                'tipoEvento' => $evento->getTipoEvento()->getDescripcion(),
                'contenido' => $evento->getContenido(),    
                );  
        }
         $response->setData($data);
         return $response;         
    }
    /**
     * @Route("/mantenedor", name="mantenedor")
     */
    public function MantenedorAction()
    {   
        //Filtro de accesos 
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
           return $this->render('error_login.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));    
    }
        
        /* Recobrar los datos dependiendo de la ID de mantenedor */
        $eventos = $this->getDoctrine()
                ->getRepository('AppBundle:Evento')
               ->findBy(array('eliminado' => false));
        
        return $this->render('mantenedor/mantenedor.html.twig', array('eventos'=>$eventos)
        );
    }
     /**
     * @Route("/agregar", name="agregar_evento" )
     */
    public function agregarEventoAction(Request $request)
    {   
        //Filtro de accesos 
        if (false === $this->get('security.context')->isGranted('ROLE_SUPER_ADMIN')) {
           return $this->render('error_login.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));    
    }
        
        $even= new Evento();
        $even->setfechaInicio(new \DateTime('now')); 
        $even->setfechaTermino(new \DateTime('now')); 
        $form = $this->createFormBuilder($even)    
            ->add('contenido', 'text')
            ->add('fechaInicio','date')
            ->add('fechaTermino', 'date')
            ->add('tipoEvento', EntityType::class, array(
                    'class' => 'AppBundle:TipoEvento',
                    'choice_label' => 'descripcion',
                ))
            ->add('guardar' ,'submit', array('label' => 'Guardar'))    
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
           $em = $this->getDoctrine()->getManager();
           $even->setEliminado(false);
           $em->persist($even);
           /* insertamos los datos */
           $em->flush();
           return $this->redirect($this->generateUrl('mantenedor'));
        }
//         throw new \LogicException('ejecutando');   
        return $this->render('mantenedor/agregar_evento.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/mantenedor/editar/{id}", name="editar")
     */
    public function editarAction($id, Request $request)
    {   
        //Filtro de accesos 
        if (false === $this->get('security.context')->isGranted('ROLE_SUPER_ADMIN')) {
           return $this->render('error_login.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));    
    }
        
        /* Recobrar los datos para editar dependiendo de la Id que se envie del mantenedor */
        $even = $this->getDoctrine()
                ->getRepository('AppBundle:Evento')
                ->find($id);
        $form = $this->createFormBuilder($even)    
            ->add('contenido', 'text')
            ->add('fechaInicio','date')
            ->add('fechaTermino', 'date')
            ->add('tipoEvento', EntityType::class, array(
                    'class' => 'AppBundle:TipoEvento',
                    'choice_label' => 'descripcion',
                ))
            ->add('guardar' ,'submit', array('label' => 'Guardar'))    
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
           $em = $this->getDoctrine()->getManager();
           $em->persist($even);
           /* insertamos los datos */
           $em->flush();
           return $this->redirect($this->generateUrl('mantenedor'));
        }
//         throw new \LogicException('ejecutando');   
        return $this->render('mantenedor/editar_mantenedor.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/yes_no/{id}", name="eliminar" , options={"expose"=true})
     */
    public function eliminarAction($id)
    {
        
       $even = $this->getDoctrine()
                ->getRepository('AppBundle:Evento')
                ->find($id);
  
           $em = $this->getDoctrine()->getManager();
           $even->setEliminado(true);
           $em->persist($even);
           /* insertamos los datos */
           $em->flush();
           return $this->redirect($this->generateUrl('mantenedor'));
        
       
    }
}
