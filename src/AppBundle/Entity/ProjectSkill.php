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
     * @var Project
     * 
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="projectSkills")
     */
    private $project;
    
    /**
     * @var Skill
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Skill", inversedBy="projectSkills")
     */
    private $skill;


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
        $project->addProjectSkill($this);

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
}
