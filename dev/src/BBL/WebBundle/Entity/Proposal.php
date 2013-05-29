<?php

namespace BBL\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proposal
 *
 * @ORM\Table(name="proposal")
 * @ORM\Entity
 */
class Proposal
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idProposal", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproposal;

    /**
     * @var string
     *
     * @ORM\Column(name="Info_Text", type="string", length=45, nullable=true)
     */
    private $infoText;

    /**
     * @var \Post
     *
     * @ORM\ManyToOne(targetEntity="Post")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Post_idPost", referencedColumnName="idPost")
     * })
     */
    private $postpost;



    /**
     * Get idproposal
     *
     * @return integer 
     */
    public function getIdproposal()
    {
        return $this->idproposal;
    }

    /**
     * Set infoText
     *
     * @param string $infoText
     * @return Proposal
     */
    public function setInfoText($infoText)
    {
        $this->infoText = $infoText;
    
        return $this;
    }

    /**
     * Get infoText
     *
     * @return string 
     */
    public function getInfoText()
    {
        return $this->infoText;
    }

    /**
     * Set postpost
     *
     * @param \BBL\WebBundle\Entity\Post $postpost
     * @return Proposal
     */
    public function setPostpost(\BBL\WebBundle\Entity\Post $postpost = null)
    {
        $this->postpost = $postpost;
    
        return $this;
    }

    /**
     * Get postpost
     *
     * @return \BBL\WebBundle\Entity\Post 
     */
    public function getPostpost()
    {
        return $this->postpost;
    }
}