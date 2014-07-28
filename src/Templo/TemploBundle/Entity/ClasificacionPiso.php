<?php
namespace Templo\TemploBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Templo\TemploBundle\Entity\Property
 *
 * @ORM\Table(name="property")
 * @ORM\Entity(repositoryClass="Templo\TemploBundle\Entity\PropertyRepository") 
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
    private $id;

    /**
     * @var text $title    
     *
     * @ORM\Column(type="text")
     */
    private $title;

    /**
     * @var text $description
     *    
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var text $content   
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;
    
    /**
     * @var boolean $published
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $published;

    /**
     * @var datetime $published_at
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    private $publishedAt;
   

    /**
     * @var object $user
     *
     * @ORM\ManyToOne(targetEntity="Templo\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Templo\TemploBundle\Entity\PropertyHasTag", mappedBy="property", cascade={"persist"})
     */
    public $propertyHasTags;

    /**
     * @ORM\OneToMany(targetEntity="Templo\TemploBundle\Entity\UserStarsProperty", mappedBy="user", cascade={"persist"})
     */
    private $userStarsProperty;
    

    /**
     * @var datetime $updated_at
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @var datetime $created_at
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

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

    /**
     * Return the list of tags separated by comma
     *
     * Useful in "keywords" meta tag
     */
    public function getCommaSeparatedTags()
    {
        $tags = array();

        foreach ($this->getPropertyHasTags() as $bht) {
            $tags[] = $bht->getTag();
        }

        return implode($tags, ', ');
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
        $this->userStarsProperty = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Property
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
     * Set description
     *
     * @param string $description
     * @return Property
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Property
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Property
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
     * Add propertyHasTag
     *
     * @param \Templo\TemploBundle\Entity\PropertyHasTag $propertyHasTags
     * @return Property
     */
    public function addPropertyHasTag(\Templo\TemploBundle\Entity\PropertyHasTag $propertyHasTags)
    {
        $this->propertyHasTags[] = $propertyHasTags;
    
        return $this;
    }

    /**
     * Remove propertyHasTag
     *
     * @param \Templo\TemploBundle\Entity\PropertyHasTag $propertyHasTag
     */
    public function removePropertyHasTag(\Templo\TemploBundle\Entity\PropertyHasTag $propertyHasTag)
    {
        $this->propertyHasTags->removeElement($propertyHasTag);
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

    /**
     * Add userStarsProperty
     *
     * @param \Templo\TemploBundle\Entity\UserStarsProperty $userStarsProperty
     * @return Property
     */
    public function addUserStarsProperty(\Templo\TemploBundle\Entity\UserStarsProperty $userStarsProperty)
    {
        $this->userStarsProperty[] = $userStarsProperty;
    
        return $this;
    }

    /**
     * Remove userStarsProperties
     *
     * @param \Templo\TemploBundle\Entity\UserStarsProperty $userStarsProperty
     */
    public function removeUserStarsProperty(\Templo\TemploBundle\Entity\UserStarsProperty $userStarsProperty)
    {
        $this->userStarsProperty->removeElement($userStarsProperty);
    }

    /**
     * Get userStarsProperty
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserStarsProperty()
    {
        return $this->userStarsProperty;
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
}