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
    

    /**
     * Get idkonto
     *
     * @return integer 
     */
    public function getIdkonto()
    {
        return $this->idkonto;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Konto
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add genregenre
     *
     * @param \BBL\WebBundle\Entity\Genre $genregenre
     * @return Konto
     */
    public function addGenregenre(\BBL\WebBundle\Entity\Genre $genregenre)
    {
        $this->genregenre[] = $genregenre;
    
        return $this;
    }

    /**
     * Remove genregenre
     *
     * @param \BBL\WebBundle\Entity\Genre $genregenre
     */
    public function removeGenregenre(\BBL\WebBundle\Entity\Genre $genregenre)
    {
        $this->genregenre->removeElement($genregenre);
    }

    /**
     * Get genregenre
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGenregenre()
    {
        return $this->genregenre;
    }

    /**
     * Add iduser
     *
     * @param \BBL\WebBundle\Entity\User $iduser
     * @return Konto
     */
    public function addIduser(\BBL\WebBundle\Entity\User $iduser)
    {
        $this->iduser[] = $iduser;
    
        return $this;
    }

    /**
     * Remove iduser
     *
     * @param \BBL\WebBundle\Entity\User $iduser
     */
    public function removeIduser(\BBL\WebBundle\Entity\User $iduser)
    {
        $this->iduser->removeElement($iduser);
    }

    /**
     * Get iduser
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set profil
     *
     * @param \BBL\WebBundle\Entity\Profil $profil
     * @return Konto
     */
    public function setProfil(\BBL\WebBundle\Entity\Profil $profil = null)
    {
        $this->profil = $profil;
    
        return $this;
    }

    /**
     * Get profil
     *
     * @return \BBL\WebBundle\Entity\Profil 
     */
    public function getProfil()
    {
        return $this->profil;
    }
}