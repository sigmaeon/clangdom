<?php

namespace BBL\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profil
 *
 * @ORM\Table(name="profil")
 * @ORM\Entity
 */
class Profil
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idProfil", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idprofil;

    /**
     * @var string
     *
     * @ORM\Column(name="Link", type="string", length=45, nullable=false)
     */
    private $link;

    /**
     * @var \Picture
     *
     * @ORM\ManyToOne(targetEntity="Picture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Picture", referencedColumnName="idPicture")
     * })
     */
    private $picture;



    /**
     * Get idprofil
     *
     * @return integer 
     */
    public function getIdprofil()
    {
        return $this->idprofil;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Profil
     */
    public function setLink($link)
    {
        $this->link = $link;
    
        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set picture
     *
     * @param \BBL\WebBundle\Entity\Picture $picture
     * @return Profil
     */
    public function setPicture(\BBL\WebBundle\Entity\Picture $picture = null)
    {
        $this->picture = $picture;
    
        return $this;
    }

    /**
     * Get picture
     *
     * @return \BBL\WebBundle\Entity\Picture 
     */
    public function getPicture()
    {
        return $this->picture;
    }
}