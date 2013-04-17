<?php

namespace BBL\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Artist
 *
 * @ORM\Table(name="artist")
 * @ORM\Entity
 */
class Artist
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idArtist", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idartist;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Genre", inversedBy="artistartist")
     * @ORM\JoinTable(name="artist_has_genre",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Artist_idArtist", referencedColumnName="idArtist")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Genre_idGenre", referencedColumnName="idGenre")
     *   }
     * )
     */
    private $genregenre;

    /**
     * @var \Konto
     *
     * @ORM\ManyToOne(targetEntity="Konto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Konto", referencedColumnName="idKonto")
     * })
     */
    private $konto;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->genregenre = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get idartist
     *
     * @return integer 
     */
    public function getIdartist()
    {
        return $this->idartist;
    }

    /**
     * Add genregenre
     *
     * @param \BBL\WebBundle\Entity\Genre $genregenre
     * @return Artist
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
     * Set konto
     *
     * @param \BBL\WebBundle\Entity\Konto $konto
     * @return Artist
     */
    public function setKonto(\BBL\WebBundle\Entity\Konto $konto = null)
    {
        $this->konto = $konto;
    
        return $this;
    }

    /**
     * Get konto
     *
     * @return \BBL\WebBundle\Entity\Konto 
     */
    public function getKonto()
    {
        return $this->konto;
    }
}