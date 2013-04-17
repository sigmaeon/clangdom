<?php

namespace BBL\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tasks
 *
 * @ORM\Table(name="tasks")
 * @ORM\Entity
 */
class Tasks
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idTasks", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtasks;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Source", mappedBy="taskstasks")
     */
    private $sourcesource;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sourcesource = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get idtasks
     *
     * @return integer 
     */
    public function getIdtasks()
    {
        return $this->idtasks;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Tasks
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
     * Add sourcesource
     *
     * @param \BBL\WebBundle\Entity\Source $sourcesource
     * @return Tasks
     */
    public function addSourcesource(\BBL\WebBundle\Entity\Source $sourcesource)
    {
        $this->sourcesource[] = $sourcesource;
    
        return $this;
    }

    /**
     * Remove sourcesource
     *
     * @param \BBL\WebBundle\Entity\Source $sourcesource
     */
    public function removeSourcesource(\BBL\WebBundle\Entity\Source $sourcesource)
    {
        $this->sourcesource->removeElement($sourcesource);
    }

    /**
     * Get sourcesource
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSourcesource()
    {
        return $this->sourcesource;
    }
}