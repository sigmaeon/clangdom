<?php

namespace BBL\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tags
 *
 * @ORM\Table(name="tags")
 * @ORM\Entity
 */
class Tags
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idTags", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtags;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Konto", mappedBy="tagstags")
     */
    private $kontokonto;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="tagstags")
     */
    private $postpost;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->kontokonto = new \Doctrine\Common\Collections\ArrayCollection();
        $this->postpost = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get idtags
     *
     * @return integer 
     */
    public function getIdtags()
    {
        return $this->idtags;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Tags
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
     * @return Tags
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

    /**
     * Add postpost
     *
     * @param \BBL\WebBundle\Entity\Post $postpost
     * @return Tags
     */
    public function addPostpost(\BBL\WebBundle\Entity\Post $postpost)
    {
        $this->postpost[] = $postpost;
    
        return $this;
    }

    /**
     * Remove postpost
     *
     * @param \BBL\WebBundle\Entity\Post $postpost
     */
    public function removePostpost(\BBL\WebBundle\Entity\Post $postpost)
    {
        $this->postpost->removeElement($postpost);
    }

    /**
     * Get postpost
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPostpost()
    {
        return $this->postpost;
    }
}