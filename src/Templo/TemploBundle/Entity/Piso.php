<?php
namespace Templo\TemploBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Templo\TemploBundle\Entity\Piso
 *
 * @ORM\Entity
 * @ORM\Table(name="piso")
 */
class Piso extends Inmueble
{
    /**
     * @ORM\Column(type="integer", nullable=false)  
     *  @Assert\NotBlank() 
     */
    protected $habitaciones;
    
     /**
     * @ORM\Column(type="integer") 
     */
    protected $trasteros;

    
   


    /**
     * Set habitaciones
     *
     * @param integer $habitaciones
     * @return Piso
     */
    public function setHabitaciones($habitaciones)
    {
        $this->habitaciones = $habitaciones;

        return $this;
    }

    /**
     * Get habitaciones
     *
     * @return integer 
     */
    public function getHabitaciones()
    {
        return $this->habitaciones;
    }

    /**
     * Set trasteros
     *
     * @param integer $trasteros
     * @return Piso
     */
    public function setTrasteros($trasteros)
    {
        $this->trasteros = $trasteros;

        return $this;
    }

    /**
     * Get trasteros
     *
     * @return integer 
     */
    public function getTrasteros()
    {
        return $this->trasteros;
    }
    
}
