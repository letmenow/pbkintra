<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="TipoEvento")
 */
class TipoEvento {
   /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer" , name="TIPO_ID")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="text" , name="TIPO_DESCRIPCION")
     */
    protected $descripcion;
    
    function getId() {
        return $this->id;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
        return $this;
    }
    
    /**
     * @ORM\OneToMany(targetEntity="Evento", mappedBy="TipoEvento")
     */
    protected $eventos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->eventos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add eventos
     *
     * @param \AppBundle\Entity\Evento $eventos
     * @return TipoEvento
     */
    public function addEvento(\AppBundle\Entity\Evento $eventos)
    {
        $this->eventos[] = $eventos;

        return $this;
    }

    /**
     * Remove eventos
     *
     * @param \AppBundle\Entity\Evento $eventos
     */
    public function removeEvento(\AppBundle\Entity\Evento $eventos)
    {
        $this->eventos->removeElement($eventos);
    }

    /**
     * Get eventos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEventos()
    {
        return $this->eventos;
    }
}
