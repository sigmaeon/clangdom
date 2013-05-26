<?php

namespace BBL\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Music
 *
 * @ORM\Table(name="music")
 * @ORM\Entity
 */
class Music
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idMusic", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmusic;

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
     * @var \File
     *
     * @ORM\ManyToOne(targetEntity="File")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="File", referencedColumnName="idFile")
     * })
     */
    private $file;



    /**
     * Get idmusic
     *
     * @return integer 
     */
    public function getIdmusic()
    {
        return $this->idmusic;
    }

    /**
     * Set post
     *
     * @param \BBL\WebBundle\Entity\Post $post
     * @return Music
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
     * Set file
     *
     * @param \BBL\WebBundle\Entity\File $file
     * @return Music
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