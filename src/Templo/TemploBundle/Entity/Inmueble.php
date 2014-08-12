<?php

namespace Templo\TemploBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Templo\TemploBundle\Entity\Inmueble
 *
 * @ORM\Table(name="inmueble")
 * @ORM\Entity(repositoryClass="Templo\TemploBundle\Entity\InmuebleRepository") 
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"inmueble" = "Inmueble", "piso" = "Piso", "local" = "Local", "chalet" = "Chalet"})
 */
class Inmueble {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     * @Assert\NotBlank()
     */
    protected $precio_venta;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true) 
     * @Assert\NotBlank()
     */
    protected $precio_alquiler;

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

    /**
     * @var text $localidad    
     *
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     */
    protected $localidad;

    /**
     * @var text $calle
     *    
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     */
    protected $calle;

    /**
     * @var text $numero
     *    
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotBlank()
     */
    protected $numero;

    /**
     * @var text $numero
     *    
     * @ORM\Column(type="boolean") 
     * 
     */
    protected $conserje;

    /**
     * @ORM\Column(type="decimal",precision=9, scale=2, nullable=false) 
     * 
     */
    protected $gps_longitud;

    /**
     * @ORM\Column(type="decimal",precision=9, scale=2, nullable=false) 
     * 
     */
    protected $gps_altitud;

    /**
     * @ORM\Column(type="text", nullable=true) 
     */
    protected $descripcion;

    /**
     * @ORM\Column(type="string", nullable=false) 
     * @Assert\NotBlank()
     */
    protected $tipo;

    /**
     * @ORM\Column(type="string") 
     * 
     */
    protected $cocina;

    /**
     * @ORM\Column(type="boolean") 
     */
    protected $alarma;

    /**
     * @ORM\Column(type="boolean")    
     */
    protected $garaje;

    /**
     * @ORM\Column(type="integer")  
     */
    protected $bannos;

    /**
     * @ORM\Column(type="boolean") 
     */
    protected $aire_acondicionado;

    /**
     * @ORM\Column(type="boolean") 
     */
    protected $calefaccion;

    /**
     * @ORM\Column(type="string", length=1, nullable=false) 
     * @Assert\NotBlank() 
     */
    protected $certificado_energetico;

    /**
     * @ORM\Column(type="integer", nullable=false)  
     */
    protected $metros_utiles;

    /**
     * @ORM\Column(type="integer", nullable=false)  
     *  @Assert\NotBlank() 
     */
    protected $metros_construidos;

    /**
     * @ORM\Column(type="integer")  
     */
    protected $nivel_estado;

    /**
     * @var object $user
     *
     * @ORM\ManyToOne(targetEntity="Templo\UserBundle\Entity\User", inversedBy="inmuebles")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     */
    protected $user;
    

     /**
     * @ORM\OneToMany(targetEntity="FotoInmueble", mappedBy="inmueble", cascade={"persist"})
     */
    protected $fotos;

    /*     * ************************************************************************************************
     * 	custom functions
     * ************************************************************************************************ */
    
    public function __construct()
    {
        $this->fotos = new ArrayCollection();
        // your own logic
    }
    
    public function setFotos($fotos){
         foreach ($fotos as $f) {
            $f->setInmueble($this);
        }
        $this->fotos = $fotos;
    
    }
    
    public function getFotos(){
        return $this->fotos;
    }
    
    
    /**
     * return if the object is new by checking the field 'id'
     */
    public function isNew() {
        return !$this->getId();
    }
    
    public function addPhoto(FotoInmueble $foto)
    {
        $this->fotos[] = $foto;
    
        return $this;
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
     * Set precio_venta
     *
     * @param string $precioVenta
     * @return Inmueble
     */
    public function setPrecioVenta($precioVenta)
    {
        $this->precio_venta = $precioVenta;

        return $this;
    }

    /**
     * Get precio_venta
     *
     * @return string 
     */
    public function getPrecioVenta()
    {
        return $this->precio_venta;
    }

    /**
     * Set precio_alquiler
     *
     * @param string $precioAlquiler
     * @return Inmueble
     */
    public function setPrecioAlquiler($precioAlquiler)
    {
        $this->precio_alquiler = $precioAlquiler;

        return $this;
    }

    /**
     * Get precio_alquiler
     *
     * @return string 
     */
    public function getPrecioAlquiler()
    {
        return $this->precio_alquiler;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return Inmueble
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
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
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return Inmueble
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
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Inmueble
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
     * @return Inmueble
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
     * Set localidad
     *
     * @param string $localidad
     * @return Inmueble
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
     * @return Inmueble
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
     * @return Inmueble
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
     * Set conserje
     *
     * @param string $conserje
     * @return Inmueble
     */
    public function setConserje($conserje)
    {
        $this->conserje = $conserje;

        return $this;
    }

    /**
     * Get conserje
     *
     * @return string 
     */
    public function getConserje()
    {
        return $this->conserje;
    }

    /**
     * Set gps_longitud
     *
     * @param string $gpsLongitud
     * @return Inmueble
     */
    public function setGpsLongitud($gpsLongitud)
    {
        $this->gps_longitud = $gpsLongitud;

        return $this;
    }

    /**
     * Get gps_longitud
     *
     * @return string 
     */
    public function getGpsLongitud()
    {
        return $this->gps_longitud;
    }

    /**
     * Set gps_altitud
     *
     * @param string $gpsAltitud
     * @return Inmueble
     */
    public function setGpsAltitud($gpsAltitud)
    {
        $this->gps_altitud = $gpsAltitud;

        return $this;
    }

    /**
     * Get gps_altitud
     *
     * @return string 
     */
    public function getGpsAltitud()
    {
        return $this->gps_altitud;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Inmueble
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Inmueble
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set cocina
     *
     * @param string $cocina
     * @return Inmueble
     */
    public function setCocina($cocina)
    {
        $this->cocina = $cocina;

        return $this;
    }

    /**
     * Get cocina
     *
     * @return string 
     */
    public function getCocina()
    {
        return $this->cocina;
    }

    /**
     * Set alarma
     *
     * @param boolean $alarma
     * @return Inmueble
     */
    public function setAlarma($alarma)
    {
        $this->alarma = $alarma;

        return $this;
    }

    /**
     * Get alarma
     *
     * @return boolean 
     */
    public function getAlarma()
    {
        return $this->alarma;
    }

    /**
     * Set garajes
     *
     * @param integer $garajes
     * @return Inmueble
     */
    public function setGaraje($garaje)
    {
        $this->garaje = $garaje;

        return $this;
    }

    /**
     * Get garajes
     *
     * @return integer 
     */
    public function getGaraje()
    {
        return $this->garaje;
    }

    /**
     * Set bannos
     *
     * @param integer $bannos
     * @return Inmueble
     */
    public function setBannos($bannos)
    {
        $this->bannos = $bannos;

        return $this;
    }

    /**
     * Get bannos
     *
     * @return integer 
     */
    public function getBannos()
    {
        return $this->bannos;
    }

    /**
     * Set aire_acondicionado
     *
     * @param boolean $aireAcondicionado
     * @return Inmueble
     */
    public function setAireAcondicionado($aireAcondicionado)
    {
        $this->aire_acondicionado = $aireAcondicionado;

        return $this;
    }

    /**
     * Get aire_acondicionado
     *
     * @return boolean 
     */
    public function getAireAcondicionado()
    {
        return $this->aire_acondicionado;
    }

    /**
     * Set calefaccion
     *
     * @param boolean $calefaccion
     * @return Inmueble
     */
    public function setCalefaccion($calefaccion)
    {
        $this->calefaccion = $calefaccion;

        return $this;
    }

    /**
     * Get calefaccion
     *
     * @return boolean 
     */
    public function getCalefaccion()
    {
        return $this->calefaccion;
    }

    /**
     * Set certificado_energetico
     *
     * @param string $certificadoEnergetico
     * @return Inmueble
     */
    public function setCertificadoEnergetico($certificadoEnergetico)
    {
        $this->certificado_energetico = $certificadoEnergetico;

        return $this;
    }

    /**
     * Get certificado_energetico
     *
     * @return string 
     */
    public function getCertificadoEnergetico()
    {
        return $this->certificado_energetico;
    }

    /**
     * Set metros_utiles
     *
     * @param integer $metrosUtiles
     * @return Inmueble
     */
    public function setMetrosUtiles($metrosUtiles)
    {
        $this->metros_utiles = $metrosUtiles;

        return $this;
    }

    /**
     * Get metros_utiles
     *
     * @return integer 
     */
    public function getMetrosUtiles()
    {
        return $this->metros_utiles;
    }

    /**
     * Set metros_construidos
     *
     * @param integer $metrosConstruidos
     * @return Inmueble
     */
    public function setMetrosConstruidos($metrosConstruidos)
    {
        $this->metros_construidos = $metrosConstruidos;

        return $this;
    }

    /**
     * Get metros_construidos
     *
     * @return integer 
     */
    public function getMetrosConstruidos()
    {
        return $this->metros_construidos;
    }

    /**
     * Set nivel_estado
     *
     * @param integer $nivelEstado
     * @return Inmueble
     */
    public function setNivelEstado($nivelEstado)
    {
        $this->nivel_estado = $nivelEstado;

        return $this;
    }

    /**
     * Get nivel_estado
     *
     * @return integer 
     */
    public function getNivelEstado()
    {
        return $this->nivel_estado;
    }

   
    /**
     * Set user
     *
     * @param \Templo\UserBundle\Entity\User $user
     * @return Inmueble
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
