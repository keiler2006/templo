<?php
namespace Templo\TemploBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Templo\TemploBundle\Entity\Chalet
 *
 * @ORM\Entity
 * @ORM\Table(name="chalet")
 */
class Chalet extends Inmueble
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
     * @ORM\Column(type="integer") 
     */
    protected $plantas;
    
    /**
     * @ORM\Column(type="integer") 
     */
    protected $salones;
    
    /**
     * @ORM\Column(type="integer") 
     */
    protected $metros_parcela;
    
    /**
     * @ORM\Column(type="boolean") 
     */
    protected $piscina_independiente;

    
   
    /**
     * Set habitaciones
     *
     * @param integer $habitaciones
     * @return Chalet
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
     * @return Chalet
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

    /**
     * Set plantas
     *
     * @param integer $plantas
     * @return Chalet
     */
    public function setPlantas($plantas)
    {
        $this->plantas = $plantas;

        return $this;
    }

    /**
     * Get plantas
     *
     * @return integer 
     */
    public function getPlantas()
    {
        return $this->plantas;
    }

    /**
     * Set salones
     *
     * @param integer $salones
     * @return Chalet
     */
    public function setSalones($salones)
    {
        $this->salones = $salones;

        return $this;
    }

    /**
     * Get salones
     *
     * @return integer 
     */
    public function getSalones()
    {
        return $this->salones;
    }

    /**
     * Set metros_parcela
     *
     * @param integer $metrosParcela
     * @return Chalet
     */
    public function setMetrosParcela($metrosParcela)
    {
        $this->metros_parcela = $metrosParcela;

        return $this;
    }

    /**
     * Get metros_parcela
     *
     * @return integer 
     */
    public function getMetrosParcela()
    {
        return $this->metros_parcela;
    }

    /**
     * Set piscina_independiente
     *
     * @param boolean $piscinaIndependiente
     * @return Chalet
     */
    public function setPiscinaIndependiente($piscinaIndependiente)
    {
        $this->piscina_independiente = $piscinaIndependiente;

        return $this;
    }

    /**
     * Get piscina_independiente
     *
     * @return boolean 
     */
    public function getPiscinaIndependiente()
    {
        return $this->piscina_independiente;
    }
    
}
