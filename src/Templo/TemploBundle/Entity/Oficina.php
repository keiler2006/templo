<?php
namespace Templo\TemploBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Templo\TemploBundle\Entity\Oficina
 *
 * @ORM\Entity
 * @ORM\Table(name="oficina")
 */
class Oficina extends Property
{
   

    /**
     * @var text $mio
     *
     * @ORM\ManyToOne(targetEntity="ClasificacionPiso")
     * @ORM\JoinColumn(name="clasificacion_piso_id", referencedColumnName="id", nullable=true)
     */
    protected $piso;
  
    
    /**
     * Set piso
     *
     * @param \Templo\TemploBundle\Entity\ClasificacionPiso $piso
     * @return Oficina
     */
    public function setPiso(\Templo\TemploBundle\Entity\ClasificacionPiso $piso = null)
    {
        $this->piso = $piso;

        return $this;
    }

    /**
     * Get piso
     *
     * @return \Templo\TemploBundle\Entity\ClasificacionPiso 
     */
    public function getPiso()
    {
        return $this->piso;
    }

    /**
     * Set user
     *
     * @param \Templo\UserBundle\Entity\User $user
     * @return Oficina
     */
    public function setUser(\Templo\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Templo\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
