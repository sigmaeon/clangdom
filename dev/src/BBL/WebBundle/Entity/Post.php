<?php

namespace BBL\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity
 */
class Post
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idPost", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpost;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Datum", type="date", nullable=false)
     */
    private $datum;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var \Konto
     *
     * @ORM\ManyToOne(targetEntity="Konto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Konto", referencedColumnName="idKonto")
     * })
     */
    private $konto;



    /**
     * Get idpost
     *
     * @return integer 
     */
    public function getIdpost()
    {
        return $this->idpost;
    }

    /**
     * Set datum
     *
     * @param \DateTime $datum
     * @return Post
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;
    
        return $this;
    }

    /**
     * Get datum
     *
     * @return \DateTime 
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Post
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
     * Set konto
     *
     * @param \BBL\WebBundle\Entity\Konto $konto
     * @return Post
     */
    public function setKonto(\BBL\WebBundle\Entity\Konto $konto = null)
    {
        $this->konto = $konto;
    
        return $this;
    }

    /**
     * Get konto
     *
     * @return \BBL\WebBundle\Entity\Konto 
     */
    public function getKonto()
    {
        return $this->konto;
    }
}