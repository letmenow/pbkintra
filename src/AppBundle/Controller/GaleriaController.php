<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Fotos;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;

     /**
     * @Route("/")
     */
class GaleriaController extends Controller{
    
     /**
     * @Route("/upload", name="subir_fotos")
     */
    public function uploadAction(Request $request)
    {
        $fotos = new Fotos();
        $form = $this->createFormBuilder($fotos)
            ->add('titulo')
            ->add('file')
             ->add('album', EntityType::class, array(
                    'class' => 'AppBundle:Album',
                    'choice_label' => 'id',
                ))    
            ->getForm();
        $form->handleRequest($request);
       
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fotos);
            $em->flush();
            $id=$fotos->getId();

            return $this->redirectToRoute('fotos', array('fotos'=>$fotos, 'id'=>$id));
        }
       
        return $this->render('fotos/subir_fotos.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    
    
}
