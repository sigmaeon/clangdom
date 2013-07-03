<?php

namespace BBL\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity
 */
class Message
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idMessage", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmessage;

    /**
     * @var string
     *
     * @ORM\Column(name="Subject", type="string", length=45, nullable=true)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="Text", type="text", nullable=false)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Datetime", type="datetime", nullable=false)
     */
    private $datetime;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Checked", type="boolean", nullable=false)
     */
    private $checked;

    /**
     * @var \Konto
     *
     * @ORM\ManyToOne(targetEntity="Konto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Sender", referencedColumnName="idKonto")
     * })
     */
    private $sender;

    /**
     * @var \Konto
     *
     * @ORM\ManyToOne(targetEntity="Konto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Recipient", referencedColumnName="idKonto")
     * })
     */
    private $recipient;



    /**
     * Get idmessage
     *
     * @return integer 
     */
    public function getIdmessage()
    {
        return $this->idmessage;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return Message
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    
        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Message
     */
    public function setText($text)
    {
        $this->text = $text;
    
        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     * @return Message
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
    
        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime 
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set checked
     *
     * @param boolean $checked
     * @return Message
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;
    
        return $this;
    }

    /**
     * Get checked
     *
     * @return boolean 
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * Set sender
     *
     * @param \BBL\WebBundle\Entity\Konto $sender
     * @return Message
     */
    public function setSender(\BBL\WebBundle\Entity\Konto $sender = null)
    {
        $this->sender = $sender;
    
        return $this;
    }

    /**
     * Get sender
     *
     * @return \BBL\WebBundle\Entity\Konto 
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set recipient
     *
     * @param \BBL\WebBundle\Entity\Konto $recipient
     * @return Message
     */
    public function setRecipient(\BBL\WebBundle\Entity\Konto $recipient = null)
    {
        $this->recipient = $recipient;
    
        return $this;
    }

    /**
     * Get recipient
     *
     * @return \BBL\WebBundle\Entity\Konto 
     */
    public function getRecipient()
    {
        return $this->recipient;
    }
}