<?php

namespace BBL\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Location
 *
 * @ORM\Table(name="location")
 * @ORM\Entity
 */
class Location
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idLocation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlocation;

    /**
     * @var string
     *
     * @ORM\Column(name="Country", type="string", length=45, nullable=false)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="Federal_State", type="string", length=45, nullable=false)
     */
    private $federalState;

    /**
     * @var string
     *
     * @ORM\Column(name="Region", type="string", length=45, nullable=false)
     */
    private $region;



    /**
     * Get idlocation
     *
     * @return integer 
     */
    public function getIdlocation()
    {
        return $this->idlocation;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Location
     */
    public function setCountry($country)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set federalState
     *
     * @param string $federalState
     * @return Location
     */
    public function setFederalState($federalState)
    {
        $this->federalState = $federalState;
    
        return $this;
    }

    /**
     * Get federalState
     *
     * @return string 
     */
    public function getFederalState()
    {
        return $this->federalState;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return Location
     */
    public function setRegion($region)
    {
        $this->region = $region;
    
        return $this;
    }

    /**
     * Get region
     *
     * @return string 
     */
    public function getRegion()
    {
        return $this->region;
    }
}