<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Step
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="StepRepository")
 */
class Step
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @var Project
     *
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="steps")
     */
    private $project;
    
     /**
     * @var Status
     *
     * @ORM\ManyToOne(targetEntity="Status", inversedBy="steps")
     */
    private $status;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Step
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
     * Set project
     *
     * @param Project $project
     * @return Step
     */
    public function setProject(Project $project = null)
    {
        $this->project = $project;
        $project->addStep($this);

        return $this;
    }

    /**
     * Get project
     *
     * @return Project 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set status
     *
     * @param Status $status
     * @return Step
     */
    public function setStatus(Status $status = null)
    {
        $this->status = $status;
        $status->addStep($this);
        return $this;
    }

    /**
     * Get status
     *
     * @return Status 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
