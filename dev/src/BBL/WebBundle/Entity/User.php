<?php

namespace BBL\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idUser", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="eMail", type="string", length=45, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Konto", inversedBy="iduser")
     * @ORM\JoinTable(name="user_has_konto",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idUser", referencedColumnName="idUser")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idKonto", referencedColumnName="idKonto")
     *   }
     * )
     */
    private $idkonto;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idkonto = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get iduser
     *
     * @return integer 
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Add idkonto
     *
     * @param \BBL\WebBundle\Entity\Konto $idkonto
     * @return User
     */
    public function addIdkonto(\BBL\WebBundle\Entity\Konto $idkonto)
    {
        $this->idkonto[] = $idkonto;
    
        return $this;
    }

    /**
     * Remove idkonto
     *
     * @param \BBL\WebBundle\Entity\Konto $idkonto
     */
    public function removeIdkonto(\BBL\WebBundle\Entity\Konto $idkonto)
    {
        $this->idkonto->removeElement($idkonto);
    }

    /**
     * Get idkonto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdkonto()
    {
        return $this->idkonto;
    }
}