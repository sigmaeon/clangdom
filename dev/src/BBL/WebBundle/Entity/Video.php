<?php

namespace BBL\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Video
 *
 * @ORM\Table(name="video")
 * @ORM\Entity
 */
class Video
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idVideo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idvideo;

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
     * Get idvideo
     *
     * @return integer 
     */
    public function getIdvideo()
    {
        return $this->idvideo;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Video
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
     * @return Video
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