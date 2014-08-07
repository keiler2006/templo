<?php
namespace Templo\TemploBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Templo\TemploBundle\Entity\Local
 *
 * @ORM\Entity
 * @ORM\Table(name="local")
 */
class Local extends Inmueble
{
    /**
     * @ORM\Column(type="integer") 
     */
    protected $plantas;

    
    

    /**
     * Set plantas
     *
     * @param integer $plantas
     * @return Local
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

   
}
