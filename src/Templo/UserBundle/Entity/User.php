<?php
namespace Templo\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use FOS\MessageBundle\Model\ParticipantInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Templo\TemploBundle\Entity\Property;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @Vich\Uploadable
 */
class User extends BaseUser implements ParticipantInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
   
    /**
     * @var boolean $emailpolicy_send_on_new_message
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $emailpolicy_send_on_new_message = true;

    /**
     * @Assert\File(
     *     maxSize="1M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg", "image/gif"}
     * )
     * @Vich\UploadableField(mapping="user_profile_image", fileNameProperty="profileImageName")
     *
     * @var File $profileImage
     */
    public $profileImage;

    /**
     * @ORM\Column(type="string", length=255, name="profile_image_name", nullable=true)
     *
     * @var string $profileImageName
     */
    protected $profileImageName;

    /**
     * @var datetime $created_at
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @var datetime $updated_at
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;

    /**
     * @ORM\OneToMany(targetEntity="Templo\TemploBundle\Entity\Property", mappedBy="user", cascade={"persist"})
     * @ORM\OrderBy({"created_at" = "ASC"})
     */
    protected $properties;

    /**
     * @ORM\OneToMany(targetEntity="Templo\TemploBundle\Entity\UserStarsProperty", mappedBy="user", cascade={"persist"})
     */
    protected $userStarsProperties;

    /**************************************************************************************************
     *	custom functions
     **************************************************************************************************/
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * return if a user marked a $property as "starred".
     *
     * marking a property as "starred" is like putting it in the "favorites"
     *
     * @param Property $property
     * @return boolean
     */
    public function isStarringProperty(Property $property)
    {
        foreach ($this->getUserStarsProperties() as $usp) {
            if ($usp->getProperty() && $usp->getProperty()->getId() === $property->getId()) {
                return true;
            }
        }

        return false;
    }

    /**
     * return the starred properties for a user
     *
     * @return multitype:NULL
     */
    public function getStarredProperties()
    {
        $entities = array();

        foreach ($this->getUserStarsProperties() as $usp) {
            $entities[] = $usp->getProperty();
        }

        return $entities;
    }

    /**
     * VichUploaderBundle Fix
     * Dirty, but https://github.com/dustin10/VichUploaderBundle/issues/8 is still an open problem
     */
    public function setProfileImage($file)
    {
        $this->profileImage = $file;

        if ($file instanceof UploadedFile) {
            $this->setUpdatedAt(new \DateTime());
        }
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
     * Set emailpolicy_send_on_new_message
     *
     * @param boolean $emailpolicySendOnNewMessage
     * @return User
     */
    public function setEmailpolicySendOnNewMessage($emailpolicySendOnNewMessage)
    {
        $this->emailpolicy_send_on_new_message = $emailpolicySendOnNewMessage;
    
        return $this;
    }

    /**
     * Get emailpolicy_send_on_new_message
     *
     * @return boolean 
     */
    public function getEmailpolicySendOnNewMessage()
    {
        return $this->emailpolicy_send_on_new_message;
    }

    /**
     * Set profileImageName
     *
     * @param string $profileImageName
     * @return User
     */
    public function setProfileImageName($profileImageName)
    {
        $this->profileImageName = $profileImageName;
    
        return $this;
    }

    /**
     * Get profileImageName
     *
     * @return string 
     */
    public function getProfileImageName()
    {
        return $this->profileImageName;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return User
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
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return User
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
     * Add property
     *
     * @param \Templo\TemploBundle\Entity\Property $property
     * @return User
     */
    public function addproperty(\Templo\TemploBundle\Entity\Property $property)
    {
        $this->properties[] = $property;
    
        return $this;
    }

    /**
     * Remove property
     *
     * @param \Templo\TemploBundle\Entity\Property $property
     */
    public function removeProperty(\Templo\TemploBundle\Entity\Property $property)
    {
        $this->properties->removeElement($property);
    }

    /**
     * Get properties
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Add userStarsProperty
     *
     * @param \Templo\TemploBundle\Entity\UserStarsProperty $userStarsProperty
     * @return User
     */
    public function addUserStarsBrick(\Templo\TemploBundle\Entity\UserStarsProperty $userStarsProperty)
    {
        $this->userStarsProperties[] = $userStarsProperty;
    
        return $this;
    }

    /**
     * Remove userStarsProperty
     *
     * @param \Templo\TemploBundle\Entity\UserStarsProperty $userStarsProperty
     */
    public function removeUserStarsProperty(\Templo\TemploBundle\Entity\UserStarsProperty $userStarsProperty)
    {
        $this->userStarsProperties->removeElement($userStarsProperties);
    }

    /**
     * Get userStarsProperties
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserStarsProperties()
    {
        return $this->userStarsProperties;
    }
}