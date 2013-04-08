<?php

namespace BBL\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Konto
 *
 * @ORM\Table(name="konto")
 * @ORM\Entity
 */
class Konto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idKonto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idkonto;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Genre", inversedBy="kontokonto")
     * @ORM\JoinTable(name="konto_has_genre",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Konto_idKonto", referencedColumnName="idKonto")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Genre_idGenre", referencedColumnName="idGenre")
     *   }
     * )
     */
    private $genregenre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", mappedBy="idkonto")
     */
    private $iduser;

    /**
     * @var \Profil
     *
     * @ORM\ManyToOne(targetEntity="Profil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Profil", referencedColumnName="idProfil")
     * })
     */
    private $profil;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->genregenre = new \Doctrine\Common\Collections\ArrayCollection();
        $this->iduser = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
}
