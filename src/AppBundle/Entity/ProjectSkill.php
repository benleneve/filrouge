<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectSkill
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ProjectSkillRepository")
 */
class ProjectSkill
{
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var Project
     * 
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="projectSkills")
     */
    private $project;
    
    /**
     * @var Skill
     *
     * @ORM\ManyToOne(targetEntity="Skill", inversedBy="projectSkills")
     */
    private $skill;
    
    /**
     * 
     * @ORM\Column(name="applicants", type="array")
     */
    private $applicants;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->applicants = array();
    }
    
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
     * Set active
     *
     * @param boolean $active
     * @return ProjectSkill
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set project
     *
     * @param Project $project
     * @return ProjectSkill
     */
    public function setProject(Project $project)
    {
        $this->project = $project;

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
     * Set skill
     *
     * @param Skill $skill
     * @return ProjectSkill
     */
    public function setSkill(Skill $skill)
    {
        $this->skill = $skill;
        $skill->addProjectSkills($this);

        return $this;
    }

    /**
     * Get skill
     *
     * @return Skill 
     */
    public function getSkill()
    {
        return $this->skill;
    }
    
    public function addApplicants($applicants) {
        $this->applicants[] = $applicants;
        return $this;
    }

    public function getApplicants() {
        return $this->applicants;
    }
}
