<?php

namespace BBL\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nachricht
 *
 * @ORM\Table(name="nachricht")
 * @ORM\Entity
 */
class Nachricht
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idNachricht", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idnachricht;

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
     * @ORM\Column(name="Date", type="date", nullable=false)
     */
    private $date;

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
     * Get idnachricht
     *
     * @return integer 
     */
    public function getIdnachricht()
    {
        return $this->idnachricht;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return Nachricht
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
     * @return Nachricht
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
     * Set date
     *
     * @param \DateTime $date
     * @return Nachricht
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
     * Set checked
     *
     * @param boolean $checked
     * @return Nachricht
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
     * @return Nachricht
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
     * @return Nachricht
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