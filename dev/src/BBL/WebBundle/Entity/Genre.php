<?php

namespace BBL\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="genre")
 * @ORM\Entity
 */
class Genre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idGenre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idgenre;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Konto", mappedBy="genregenre")
     */
    private $kontokonto;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->kontokonto = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get idgenre
     *
     * @return integer 
     */
    public function getIdgenre()
    {
        return $this->idgenre;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Genre
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
     * Add kontokonto
     *
     * @param \BBL\WebBundle\Entity\Konto $kontokonto
     * @return Genre
     */
    public function addKontokonto(\BBL\WebBundle\Entity\Konto $kontokonto)
    {
        $this->kontokonto[] = $kontokonto;
    
        return $this;
    }

    /**
     * Remove kontokonto
     *
     * @param \BBL\WebBundle\Entity\Konto $kontokonto
     */
    public function removeKontokonto(\BBL\WebBundle\Entity\Konto $kontokonto)
    {
        $this->kontokonto->removeElement($kontokonto);
    }

    /**
     * Get kontokonto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getKontokonto()
    {
        return $this->kontokonto;
    }
}