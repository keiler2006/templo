<?php
namespace Templo\TemploBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Templo\TemploBundle\Entity\PropertyHasTag
 * 
 * @ORM\Entity
 * @ORM\Table(name="property_has_tag")
 * @ORM\Entity(repositoryClass="Templo\TemploBundle\Entity\PropertyHasTagRepository")
 */
class PropertyHasTag
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var object $property
     *
     * @ORM\ManyToOne(targetEntity="Templo\TemploBundle\Entity\Property", cascade={"persist"})
     * @ORM\JoinColumn(name="property_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $property;

    /**
     * @var object $tag
     *
     * @ORM\ManyToOne(targetEntity="Templo\TemploBundle\Entity\Tag", cascade={"persist"})
     * @ORM\JoinColumn(name="tag_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $tag;
    
    /**************************************************************************************************
     *	custom functions
    **************************************************************************************************/
    
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
     * Set property
     *
     * @param \Templo\TemploBundle\Entity\Property $property
     * @return PropertyHasTag
     */
    public function setProperty(\Templo\TemploBundle\Entity\Property $property = null)
    {
        $this->property = $property;
    
        return $this;
    }

    /**
     * Get property
     *
     * @return \Templo\TemploBundle\Entity\Property 
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Set tag
     *
     * @param \Templo\TemploBundle\Entity\Tag $tag
     * @return PropertyHasTag
     */
    public function setTag(\Templo\TemploBundle\Entity\Tag $tag = null)
    {
        $this->tag = $tag;
    
        return $this;
    }

    /**
     * Get tag
     *
     * @return \Templo\TemploBundle\Entity\Tag 
     */
    public function getTag()
    {
        return $this->tag;
    }
}