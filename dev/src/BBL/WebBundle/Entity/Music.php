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
    private $path;

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
     * Set path
     *
     * @param string $url
     * @return Music
     */
    public function setPath($url)
    {
        $this->url = $url;
    
        return $this;
    }
    

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
    	return null === $this->path
    	? null
    	: $this->getUploadDir().'/'.$this->path;
    }
    
    
    protected function getUploadRootDir()
    {
    	// the absolute directory path where uploaded
    	// documents should be saved
    	return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
    
    protected function getUploadDir()
    {
    	// get rid of the __DIR__ so it doesn't screw up
    	// when displaying uploaded doc/image in the view.
    	return 'uploads/music';
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