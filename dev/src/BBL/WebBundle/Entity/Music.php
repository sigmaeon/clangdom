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
     * @var string
     *
     * @ORM\Column(name="URL", type="string", length=45, nullable=false)
     */
    private $url;

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
     * Get idmusic
     *
     * @return integer 
     */
    public function getIdmusic()
    {
        return $this->idmusic;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Music
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
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
}