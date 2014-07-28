<?php
namespace Templo\TemploBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Templo\TemploBundle\Entity\Property
 *
 * @ORM\Table(name="property")
 * @ORM\Entity(repositoryClass="Templo\TemploBundle\Entity\PropertyRepository") 
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"property" = "Property", "oficina" = "Oficina"})
 */
class Property
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var text $localidad    
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $localidad;

    /**
     * @var text $calle
     *    
     * @ORM\Column(type="string", nullable=false)
     */
    protected $calle;
    
    /**
     * @var text $numero
     *    
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $numero;
    
     /**
     * @var text $numero
     *    
     * @ORM\Column(type="string", nullable=false)
     */
    protected $urbanizacion;

    
     /**
     * @ORM\Column(type="decimal", scale=2) 
     * 
     */
    protected $precio;
    
    /**
     * @var boolean $published
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $published;

    /**
     * @var datetime $published_at
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    protected $publishedAt;
   

    /**
     * @var object $user
     *
     * @ORM\ManyToOne(targetEntity="Templo\UserBundle\Entity\User", inversedBy="properties")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     */
    protected $user;

     /**
     * @var datetime $updated_at
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updated_at;

    /**
     * @var datetime $created_at
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $created_at;

    /**************************************************************************************************
     *	custom functions
    **************************************************************************************************/
    /**
     * return if the object is new by checking the field 'id'
     */
    public function isNew()
    {
        return !$this->getId();
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return Property
     */
    public function setPublished($published)
    {
        $this->published = $published;

        if ($published == true) {
            $this->setPublishedAt(new \Datetime());
        }

        return $this;
    }




    /**************************************************************************************************
     *	getters and setters
    **************************************************************************************************/
    
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
     * Get published
     *
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
    }

   
    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Property
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Property
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set user
     *
     * @param \Templo\UserBundle\Entity\User $user
     * @return Property
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


   
    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return Property
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;
    
        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime 
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set localidad
     *
     * @param string $localidad
     * @return Property
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get localidad
     *
     * @return string 
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set calle
     *
     * @param string $calle
     * @return Property
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;

        return $this;
    }

    /**
     * Get calle
     *
     * @return string 
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     * @return Property
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
     * Set urbanizacion
     *
     * @param string $urbanizacion
     * @return Property
     */
    public function setUrbanizacion($urbanizacion)
    {
        $this->urbanizacion = $urbanizacion;

        return $this;
    }

    /**
     * Get urbanizacion
     *
     * @return string 
     */
    public function getUrbanizacion()
    {
        return $this->urbanizacion;
    }

    /**
     * Set precio
     *
     * @param string $precio
     * @return Property
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string 
     */
    public function getPrecio()
    {
        return $this->precio;
    }
}
