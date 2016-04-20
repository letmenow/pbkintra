<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; 
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity
 * @ORM\Table(name="Evento")
 */

class Evento {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer" , name="EVEN_ID")
     */
    protected $id;
    
     /**
     * @ORM\Column(type="datetime" , name="EVEN_FECHA_INICIO")
     * @Assert\DateTime()
     */
    protected $fechaInicio;
    
     /**
     * @ORM\Column(type="datetime" , name="EVEN_FECHA_TERMINO")
     * @Assert\DateTime()
     */
    protected $fechaTermino;
    
    /**
     * @ORM\Column(type="text" , name="EVEN_CONTENIDO")
     */
    protected $contenido;

    /**
     * @ORM\ManyToOne(targetEntity="TipoEvento", inversedBy="eventos")
     * @ORM\JoinColumn(name="EVEN_TIPO_ID", referencedColumnName="TIPO_ID")
     */
    
    protected $tipoEvento;
    
    /**
     * @ORM\Column(type="boolean", name="EVEN_ELIMINAR")
     */
    protected $eliminado;
    
    public function __construct()
    {
        $this->tipoEvento = new ArrayCollection();
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
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return Evento
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaTermino
     *
     * @param \DateTime $fechaTermino
     * @return Evento
     */
    public function setFechaTermino($fechaTermino)
    {
        $this->fechaTermino = $fechaTermino;

        return $this;
    }

    /**
     * Get fechaTermino
     *
     * @return \DateTime 
     */
    public function getFechaTermino()
    {
        return $this->fechaTermino;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     * @return Evento
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string 
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set eliminado
     *
     * @param boolean $eliminado
     * @return Evento
     */
    public function setEliminado($eliminado)
    {
        $this->eliminado = $eliminado;

        return $this;
    }

    /**
     * Get eliminado
     *
     * @return boolean 
     */
    public function getEliminado()
    {
        return $this->eliminado;
    }

    /**
     * Set tipoEvento
     *
     * @param \AppBundle\Entity\TipoEvento $tipoEvento
     * @return Evento
     */
    public function setTipoEvento(\AppBundle\Entity\TipoEvento $tipoEvento = null)
    {
        $this->tipoEvento = $tipoEvento;

        return $this;
    }

    /**
     * Get tipoEvento
     *
     * @return \AppBundle\Entity\TipoEvento 
     */
    public function getTipoEvento()
    {
        return $this->tipoEvento;
    }
}
