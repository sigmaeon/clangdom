<?php

namespace BBL\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Konto
 *
 * @ORM\Table(name="konto")
 * @ORM\Entity
 */
class Konto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idKonto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idkonto;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Confirmed", type="boolean", nullable=false)
     */
    private $confirmed;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Event", mappedBy="konto")
     */
    private $event;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Konto", inversedBy="konto")
     * @ORM\JoinTable(name="konto_has_favorit",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Konto", referencedColumnName="idKonto")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Favorit", referencedColumnName="idKonto")
     *   }
     * )
     */
    private $favorit;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Tags", inversedBy="kontokonto")
     * @ORM\JoinTable(name="konto_has_tags",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Konto_idKonto", referencedColumnName="idKonto")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Tags_idTags", referencedColumnName="idTags")
     *   }
     * )
     */
    private $tagstags;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", mappedBy="idkonto")
     */
    private $iduser;

    /**
     * @var \Profil
     *
     * @ORM\ManyToOne(targetEntity="Profil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Profil", referencedColumnName="idProfil")
     * })
     */
    private $profil;

    /**
     * @var \Location
     *
     * @ORM\ManyToOne(targetEntity="Location")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Location", referencedColumnName="idLocation")
     * })
     */
    private $location;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->event = new \Doctrine\Common\Collections\ArrayCollection();
        $this->favorit = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tagstags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->iduser = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get idkonto
     *
     * @return integer 
     */
    public function getIdkonto()
    {
        return $this->idkonto;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Konto
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set confirmed
     *
     * @param boolean $confirmed
     * @return Konto
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;
    
        return $this;
    }

    /**
     * Get confirmed
     *
     * @return boolean 
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * Add event
     *
     * @param \BBL\WebBundle\Entity\Event $event
     * @return Konto
     */
    public function addEvent(\BBL\WebBundle\Entity\Event $event)
    {
        $this->event[] = $event;
    
        return $this;
    }

    /**
     * Remove event
     *
     * @param \BBL\WebBundle\Entity\Event $event
     */
    public function removeEvent(\BBL\WebBundle\Entity\Event $event)
    {
        $this->event->removeElement($event);
    }

    /**
     * Get event
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Add favorit
     *
     * @param \BBL\WebBundle\Entity\Konto $favorit
     * @return Konto
     */
    public function addFavorit(\BBL\WebBundle\Entity\Konto $favorit)
    {
        $this->favorit[] = $favorit;
    
        return $this;
    }

    /**
     * Remove favorit
     *
     * @param \BBL\WebBundle\Entity\Konto $favorit
     */
    public function removeFavorit(\BBL\WebBundle\Entity\Konto $favorit)
    {
        $this->favorit->removeElement($favorit);
    }

    /**
     * Get favorit
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFavorit()
    {
        return $this->favorit;
    }

    /**
     * Add tagstags
     *
     * @param \BBL\WebBundle\Entity\Tags $tagstags
     * @return Konto
     */
    public function addTagstag(\BBL\WebBundle\Entity\Tags $tagstags)
    {
        $this->tagstags[] = $tagstags;
    
        return $this;
    }

    /**
     * Remove tagstags
     *
     * @param \BBL\WebBundle\Entity\Tags $tagstags
     */
    public function removeTagstag(\BBL\WebBundle\Entity\Tags $tagstags)
    {
        $this->tagstags->removeElement($tagstags);
    }

    /**
     * Get tagstags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTagstags()
    {
        return $this->tagstags;
    }

    /**
     * Add iduser
     *
     * @param \BBL\WebBundle\Entity\User $iduser
     * @return Konto
     */
    public function addIduser(\BBL\WebBundle\Entity\User $iduser)
    {
        $this->iduser[] = $iduser;
    
        return $this;
    }

    /**
     * Remove iduser
     *
     * @param \BBL\WebBundle\Entity\User $iduser
     */
    public function removeIduser(\BBL\WebBundle\Entity\User $iduser)
    {
        $this->iduser->removeElement($iduser);
    }

    /**
     * Get iduser
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set profil
     *
     * @param \BBL\WebBundle\Entity\Profil $profil
     * @return Konto
     */
    public function setProfil(\BBL\WebBundle\Entity\Profil $profil = null)
    {
        $this->profil = $profil;
    
        return $this;
    }

    /**
     * Get profil
     *
     * @return \BBL\WebBundle\Entity\Profil 
     */
    public function getProfil()
    {
        return $this->profil;
    }

    /**
     * Set location
     *
     * @param \BBL\WebBundle\Entity\Location $location
     * @return Konto
     */
    public function setLocation(\BBL\WebBundle\Entity\Location $location = null)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return \BBL\WebBundle\Entity\Location 
     */
    public function getLocation()
    {
        return $this->location;
    }
}