<?php
namespace Templo\TemploBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_stars_property")
 * @ORM\Entity(repositoryClass="Templo\TemploBundle\Entity\UserStarsPropertyRepository")
 */
class UserStarsProperty
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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

    /**
     * @var object $user
     *
     * @ORM\ManyToOne(targetEntity="Templo\UserBundle\Entity\User", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $user;

    /**
     * @var object $property
     *
     * @ORM\ManyToOne(targetEntity="Templo\TemploBundle\Entity\Property", cascade={"persist"})
     * @ORM\JoinColumn(name="property_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $property;
    
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
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return UserStarsProperty
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
     * @return UserStarsProperty
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
     * @param Templo\UserBundle\Entity\User $user
     * @return UserStarsProperty
     */
    public function setUser(\Templo\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return Templo\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set property
     *
     * @param Templo\TemploBundle\Entity\Property $property
     * @return UserStarsProperty
     */
    public function setProperty(\Templo\TemploBundle\Entity\Property $property = null)
    {
        $this->property = $property;
    
        return $this;
    }

    /**
     * Get property
     *
     * @return Templo\TemploBundle\Entity\Property 
     */
    public function getProperty()
    {
        return $this->property;
    }
}