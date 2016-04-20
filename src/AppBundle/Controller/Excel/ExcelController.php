<?php

namespace AppBundle\Controller\Excel;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Capitulo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * @Route("/")
 */
class ExcelController extends Controller
{    
    /**
     * @Route("/indice", name="indice_excel")
     */
    public function IndiceAction()
    {
        //Filtro de accesos 
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
           return $this->render('error_login.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));    
    }
        
        $unidades = $this->getDoctrine()
                ->getRepository('AppBundle:Unidad')
                ->findAll();
        $capitulos = $this->getDoctrine()
                ->getRepository('AppBundle:Capitulo')
                ->findAll();
        
        return $this->render('excel/indice_excel.html.twig', array('unidades'=>$unidades , 'capitulos'=>$capitulos)
        );
   
    }
    
    //private $capitulos;

    /**
     * @Route("/crear_cap", name="crear_capitulo")
     */
    public function crearCapAction(Request $request)
    {
        //Filtro de accesos 
        if (false === $this->get('security.context')->isGranted('ROLE_SUPER_ADMIN')) {
           return $this->render('error_login.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));    
    }
        
        $cap = new Capitulo();
        $form = $this->createFormBuilder($cap)         
            ->add('titulo', 'text')
            ->add('contenido', 'textarea' , array(
            'attr' => array('class' => 'editor1','cols' => '36', 'rows' => '8'),
             )) 
             ->add('unidad', EntityType::class, array(
                    'class' => 'AppBundle:Unidad',
                    'choice_label' => 'id',
                ))  
         ->add('save' , 'button', array('label' => 'Guardar'))      
         ->getForm();    
        $form->handleRequest($request);
        if ($form->isValid()) {
           $em = $this->getDoctrine()->getManager();
           $em->persist($cap);
           /* insertamos los datos */
           $em->flush();
           return $this->redirect($this->generateUrl('crear_capitulo'));
        }  
        return $this->render('excel/crear_capitulo.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/mostrar_capitulos/{id}", name="mostrar_capitulos" )
    */
    public function indexAction($id)
    {   
        //Filtro de accesos 
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
           return $this->render('error_login.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));    
    }
        $unidades = $this->getDoctrine()
                ->getRepository('AppBundle:Unidad')
                ->findAll();
        
        $capitulo = $this->getDoctrine()
                ->getRepository('AppBundle:Capitulo')
                ->find($id);   
        
        
        $a = ($capitulo->getNumero()-1);
        $aanterior = $this->getDoctrine()
                ->getRepository('AppBundle:Capitulo')
                ->findOneBy(array('numero' => $a));
        if($aanterior){
          $anterior = $aanterior->getId();  
        }else{
        $anterior = 0;
        }
        
        $b = ($capitulo->getNumero()+1);
        $bsiguiente = $this->getDoctrine()
                ->getRepository('AppBundle:Capitulo')
                ->findOneBy(array('numero' => $b));
        if($bsiguiente){
          $siguiente = $bsiguiente->getId();  
        }else{
        $siguiente = 0;
        }

        return $this->render('excel/capitulo.html.twig', array('unidades'=>$unidades,'capitulo'=>$capitulo, 'anterior'=>$anterior ,'siguiente'=>$siguiente)
        );
    }
}
