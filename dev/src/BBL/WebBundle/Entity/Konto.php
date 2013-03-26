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
     * @var \Profil
     *
     * @ORM\ManyToOne(targetEntity="Profil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Profil", referencedColumnName="idProfil")
     * })
     */
    private $profil;



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
}