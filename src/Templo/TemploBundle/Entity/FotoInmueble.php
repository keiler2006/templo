<?php

namespace Templo\TemploBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Templo\TemploBundle\Entity\FotoInmueble
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="fotos_inmuebles")
 */
class FotoInmueble {

    private $temp;

    /**    
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** 
     * @ORM\Column(type="string", nullable=true)
     */
    protected $name;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $path;

    /**   
     * @ORM\ManyToOne(targetEntity="Inmueble", inversedBy="fotos")
     * @ORM\JoinColumn(name="inmueble_id", referencedColumnName="id", nullable=false)
     */
    protected $inmueble;
    
    
    /**
     * @ORM\Column(type="boolean") 
     */
    protected $main;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null) {
        $this->file = $file;
        // check if we have an old image path
        if (is_file($this->getAbsolutePath())) {
        // store the old name to delete after the update
            $this->temp = $this->getAbsolutePath();
        } else {
            $this->path = 'initial';
        }
    }
    
    
    public function isMain(){
        return $this->main;
    }
    
    public function setMain($main)
    {
        $this->main = $main;
        return $this;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        if (null === $this->getFile()) {
            return;
        }
        // check if we have an old image
        if (isset($this->temp)) {
        // delete the old image
            unlink($this->temp);
        // clear the temp image path
            $this->temp = null;
        }
        // you must throw an exception here if the file cannot be moved
        // so that the entity is not persisted to the database
        // which the UploadedFile move() method does
        $this->getFile()->move(
                $this->getUploadRootDir(), $this->id . '.' . $this->getFile()->guessExtension()
        );
        $this->setFile(null);
    }

    /**
     * @ORM\PreRemove()
     */
    public function storeFilenameForRemove() {
        $this->temp = $this->getAbsolutePath();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        if (isset($this->temp)) {
            unlink($this->temp);
        }
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getPath() {
        return $this->path;
    }

    public function setPath($path) {
        $this->path = $path;
        return $this;
    }

    public function getAbsolutePath() {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->id . '.' . $this->path;
    }

    public function getWebPath() {
        return null === $this->ruta ? null : $this->getUploadDir() . '/' . $this->ruta;
    }

    protected function getUploadRootDir() {
    // the absolute directory path where uploaded
    // documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
    // get rid of the __DIR__ so it doesn't screw up
    // when displaying uploaded doc/image in the view.
        return 'uploads/documents';
    }

    /**
     * Set piso
     *
     * @param \Templo\TemploBundle\Entity\Inmueble $inmueble
     * @return FotoInmueble
     */
    public function setInmueble(\Templo\TemploBundle\Entity\Inmueble $inmueble = null) {
        $this->inmueble = $inmueble;

        return $this;
    }

    /**
     * Get piso
     *
     * @return \Templo\TemploBundle\Entity\Inmueble 
     */
    public function getInmueble() {
        return $this->inmueble;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        if (null !== $this->getFile()) {
            $this->path = $this->getFile()->guessExtension();
        }
    }

}
