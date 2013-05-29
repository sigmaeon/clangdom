<?php

namespace BBL\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity
 */
class Event
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idEvent", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idevent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Startdate", type="date", nullable=true)
     */
    private $startdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Enddate", type="date", nullable=true)
     */
    private $enddate;

    /**
     * @var string
     *
     * @ORM\Column(name="Info", type="text", nullable=true)
     */
    private $info;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Konto", inversedBy="event")
     * @ORM\JoinTable(name="event_has_konto",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Event", referencedColumnName="idEvent")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Konto", referencedColumnName="idKonto")
     *   }
     * )
     */
    private $konto;

    /**
     * @var \Post
     *
     * @ORM\ManyToOne(targetEntity="Post")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Post", referencedColumnName="idPost")
     * })
     */
    private $post;

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
     * Constructor
     */
    public function __construct()
    {
        $this->konto = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get idevent
     *
     * @return integer 
     */
    public function getIdevent()
    {
        return $this->idevent;
    }

    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     * @return Event
     */
    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;
    
        return $this;
    }

    /**
     * Get startdate
     *
     * @return \DateTime 
     */
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * Set enddate
     *
     * @param \DateTime $enddate
     * @return Event
     */
    public function setEnddate($enddate)
    {
        $this->enddate = $enddate;
    
        return $this;
    }

    /**
     * Get enddate
     *
     * @return \DateTime 
     */
    public function getEnddate()
    {
        return $this->enddate;
    }

    /**
     * Set info
     *
     * @param string $info
     * @return Event
     */
    public function setInfo($info)
    {
        $this->info = $info;
    
        return $this;
    }

    /**
     * Get info
     *
     * @return string 
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Add konto
     *
     * @param \BBL\WebBundle\Entity\Konto $konto
     * @return Event
     */
    public function addKonto(\BBL\WebBundle\Entity\Konto $konto)
    {
        $this->konto[] = $konto;
    
        return $this;
    }

    /**
     * Remove konto
     *
     * @param \BBL\WebBundle\Entity\Konto $konto
     */
    public function removeKonto(\BBL\WebBundle\Entity\Konto $konto)
    {
        $this->konto->removeElement($konto);
    }

    /**
     * Get konto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getKonto()
    {
        return $this->konto;
    }

    /**
     * Set post
     *
     * @param \BBL\WebBundle\Entity\Post $post
     * @return Event
     */
    public function setPost(\BBL\WebBundle\Entity\Post $post = null)
    {
        $this->post = $post;
    
        return $this;
    }

    /**
     * Get post
     *
     * @return \BBL\WebBundle\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set profil
     *
     * @param \BBL\WebBundle\Entity\Profil $profil
     * @return Event
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
}