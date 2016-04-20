<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Capitulo")
 */

class Capitulo {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer" , name="CAPI_ID")
     */
    protected $id;
   
    /**
     * @ORM\Column(type="text" , name="CAPI_TITULO")
     */
    protected $titulo;
    
    /**
     * @ORM\Column(type="integer" ,nullable=true, name="CAPI_NUMERO")
     */
    protected $numero;
    
    /**
     * @ORM\Column(type="text" , name="CAPI_CONTENIDO")
     */
    protected $contenido;

    /**
     * @ORM\ManyToOne(targetEntity="Unidad", inversedBy="capitulos")
     * @ORM\JoinColumn(name="CAPI_UNID_ID", referencedColumnName="UNID_ID")
     */
    protected $unidad;

    

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
     * @return Capitulo
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
     * Set numero
     *
     * @param integer $numero
     * @return Capitulo
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     * @return Capitulo
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
     * Set unidad
     *
     * @param \AppBundle\Entity\Unidad $unidad
     * @return Capitulo
     */
    public function setUnidad(\AppBundle\Entity\Unidad $unidad = null)
    {
        $this->unidad = $unidad;

        return $this;
    }

    /**
     * Get unidad
     *
     * @return \AppBundle\Entity\Unidad 
     */
    public function getUnidad()
    {
        return $this->unidad;
    }
}
