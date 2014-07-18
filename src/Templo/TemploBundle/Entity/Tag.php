<?php
namespace Templo\TemploBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Templo\TemploBundle\Entity\Tag
 *
 * @ORM\Entity(repositoryClass="Templo\TemploBundle\Entity\TagRepository")
 * @ORM\Table(name="tag")
 */
class Tag
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var text $title
     *
     * @ORM\Column(type="text")
     */
    private $title;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;
    
    /**
     * @ORM\OneToMany(targetEntity="Templo\TemploBundle\Entity\PropertyHasTag", mappedBy="tag", cascade={"persist"})
     */
    private $propertyHasTags;
    
    /**************************************************************************************************
     *	custom functions
    **************************************************************************************************/
    public function __toString()
    {
        return $this->title;
    }
    
    /**************************************************************************************************
     *	getters and setters
    **************************************************************************************************/
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->propertyHasTags = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Tag
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Tag
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add propertyHasTags
     *
     * @param \Templo\TemploBundle\Entity\PropertyHasTag $propertyHasTags
     * @return Tag
     */
    public function addPropertyHasTag(\Templo\TemploBundle\Entity\PropertyHasTag $propertyHasTags)
    {
        $this->propertyHasTags[] = $propertyHasTags;
    
        return $this;
    }

    /**
     * Remove propertyHasTags
     *
     * @param \Templo\TemploBundle\Entity\PropertyHasTag $propertyHasTags
     */
    public function removePropertyHasTag(\Templo\TemploBundle\Entity\PropertyHasTag $propertyHasTags)
    {
        $this->propertyHasTags->removeElement($propertyHasTags);
    }

    /**
     * Get propertyHasTags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPropertyHasTags()
    {
        return $this->propertyHasTags;
    }
}