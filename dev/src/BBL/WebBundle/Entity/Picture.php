<?php

namespace BBL\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Picture
 *
 * @ORM\Table(name="picture")
 * @ORM\Entity
 */
class Picture
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idPicture", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpicture;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var \File
     *
     * @ORM\ManyToOne(targetEntity="File")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="File", referencedColumnName="idFile")
     * })
     */
    private $file;



    /**
     * Get idpicture
     *
     * @return integer 
     */
    public function getIdpicture()
    {
        return $this->idpicture;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Picture
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
     * Set file
     *
     * @param \BBL\WebBundle\Entity\File $file
     * @return Picture
     */
    public function setFile(\BBL\WebBundle\Entity\File $file = null)
    {
        $this->file = $file;
    
        return $this;
    }

    /**
     * Get file
     *
     * @return \BBL\WebBundle\Entity\File 
     */
    public function getFile()
    {
        return $this->file;
    }
}