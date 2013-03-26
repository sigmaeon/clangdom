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
     * @ORM\Column(name="html", type="text", nullable=false)
     */
    private $html;



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
     * Set html
     *
     * @param string $html
     * @return Profil
     */
    public function setHtml($html)
    {
        $this->html = $html;
    
        return $this;
    }

    /**
     * Get html
     *
     * @return string 
     */
    public function getHtml()
    {
        return $this->html;
    }
}