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
     * @ORM\Column(name="Date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Tags", inversedBy="postpost")
     * @ORM\JoinTable(name="post_has_tags",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Post_idPost", referencedColumnName="idPost")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Tags_idTags", referencedColumnName="idTags")
     *   }
     * )
     */
    private $tagstags;

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
     * Constructor
     */
    public function __construct()
    {
        $this->tagstags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->date = new \DateTime("now");
    }
    

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
     * Set date
     *
     * @param \DateTime $date
     * @return Post
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
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
     * Add tagstags
     *
     * @param \BBL\WebBundle\Entity\Tags $tagstags
     * @return Post
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