<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserProject
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="UserProjectRepository")
 */
class UserProject
{

    /**
     * @var string
     *
     * @ORM\Column(name="skill", type="string", length=255)
     */
    private $skill;
    
     /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
    
    /**
     * @var User
     * 
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User", inversedBy="worksOnProjects")
     */
    private $user;
    
    /**
     * @var Project
     * 
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="projectMembers")
     */
    private $project;


    /**
     * Set skill
     *
     * @param string $skill
     * @return UserProject
     */
    public function setSkill($skill)
    {
        $this->skill = $skill;

        return $this;
    }

    /**
     * Get skill
     *
     * @return string 
     */
    public function getSkill()
    {
        return $this->skill;
    }
    
    /**
     * Set active
     *
     * @param boolean $active
     * @return UserProject
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
     * Set user
     *
     * @param User $user
     * @return UserProject
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        $user->addWorksOnProject($this);

        return $this;
    }

    /**
     * Get user
     *
     * @return User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set project
     *
     * @param Project $project
     * @return UserProject
     */
    public function setProject(Project $project)
    {
        $this->project = $project;
        $project->addProjectMember($this);

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
}
