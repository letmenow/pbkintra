<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="Album")
 */
class Album {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer" , name="ALBU_ID")
     */
    protected $id;

    /**
     * @ORM\Column(type="string" , name="ALBU_TITULO")
     * @Assert\NotBlank()
     */
    protected $titulo;
    
    /**
     * @ORM\Column(type="text" , name="ALBU_DESCRIPCION")
     */
    protected $descripcion;
    
    /**
     * @ORM\OneToMany(targetEntity="Fotos", mappedBy="Album")
     */
    
    protected $fotos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fotos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Album
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Album
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Add fotos
     *
     * @param \AppBundle\Entity\Fotos $fotos
     * @return Album
     */
    public function addFoto(\AppBundle\Entity\Fotos $fotos)
    {
        $this->fotos[] = $fotos;

        return $this;
    }

    /**
     * Remove fotos
     *
     * @param \AppBundle\Entity\Fotos $fotos
     */
    public function removeFoto(\AppBundle\Entity\Fotos $fotos)
    {
        $this->fotos->removeElement($fotos);
    }

    /**
     * Get fotos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFotos()
    {
        return $this->fotos;
    }
}
