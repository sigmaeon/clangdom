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
     * @var string
     *
     * @ORM\Column(name="Pic", type="string", length=45, nullable=true)
     */
    private $pic;



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
     * Set pic
     *
     * @param string $pic
     * @return Profil
     */
    public function setPic($pic)
    {
        $this->pic = $pic;
    
        return $this;
    }

    /**
     * Get pic
     *
     * @return string 
     */
    public function getPic()
    {
        return $this->pic;
    }
}