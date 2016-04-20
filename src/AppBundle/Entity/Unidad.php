<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="Unidad")
 */

class Unidad {
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer" , name="UNID_ID")
     */
    protected $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Capitulo", mappedBy="Unidad")
     */
    
    protected $capitulos;
    
    /**
     * @ORM\Column(type="string" , name="UNID_TITULO")
     * @Assert\NotBlank()
     */
    protected $titulo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->capitulos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Unidad
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Add capitulos
     *
     * @param \AppBundle\Entity\Capitulo $capitulos
     * @return Unidad
     */
    public function addCapitulo(\AppBundle\Entity\Capitulo $capitulos)
    {
        $this->capitulos[] = $capitulos;

        return $this;
    }

    /**
     * Remove capitulos
     *
     * @param \AppBundle\Entity\Capitulo $capitulos
     */
    public function removeCapitulo(\AppBundle\Entity\Capitulo $capitulos)
    {
        $this->capitulos->removeElement($capitulos);
    }

    /**
     * Get capitulos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCapitulos()
    {
        return $this->capitulos;
    }
}
