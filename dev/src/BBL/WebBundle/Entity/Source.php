<?php

namespace BBL\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Source
 *
 * @ORM\Table(name="source")
 * @ORM\Entity
 */
class Source
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idSource", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsource;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Tasks", inversedBy="sourcesource")
     * @ORM\JoinTable(name="source_has_tasks",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Source_idSource", referencedColumnName="idSource")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Tasks_idTasks", referencedColumnName="idTasks")
     *   }
     * )
     */
    private $taskstasks;

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
        $this->taskstasks = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get idsource
     *
     * @return integer 
     */
    public function getIdsource()
    {
        return $this->idsource;
    }

    /**
     * Add taskstasks
     *
     * @param \BBL\WebBundle\Entity\Tasks $taskstasks
     * @return Source
     */
    public function addTaskstask(\BBL\WebBundle\Entity\Tasks $taskstasks)
    {
        $this->taskstasks[] = $taskstasks;
    
        return $this;
    }

    /**
     * Remove taskstasks
     *
     * @param \BBL\WebBundle\Entity\Tasks $taskstasks
     */
    public function removeTaskstask(\BBL\WebBundle\Entity\Tasks $taskstasks)
    {
        $this->taskstasks->removeElement($taskstasks);
    }

    /**
     * Get taskstasks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTaskstasks()
    {
        return $this->taskstasks;
    }

    /**
     * Set konto
     *
     * @param \BBL\WebBundle\Entity\Konto $konto
     * @return Source
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