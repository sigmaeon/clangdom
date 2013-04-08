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
     * @ORM\Column(name="Password", type="string", length=45, nullable=false)
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
    
}
