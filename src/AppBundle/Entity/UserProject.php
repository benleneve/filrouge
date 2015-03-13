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
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
    
    /**
     * @var User
     * 
     * @ORM\ManyToOne(targetEntity="User", inversedBy="worksOnProjects")
     */
    private $user;
    
    /**
     * @var Project
     * 
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="projectMembers")
     */
    private $project;
    
    /**
     * @var Skill
     *
     * @ORM\ManyToOne(targetEntity="Skill", inversedBy="userProjectSkills")
     */
    private $skill;

    
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
    
     /**
     * Set skill
     *
     * @param Skill $skill
     * @return UserProject
     */
    public function setSkill(Skill $skill)
    {
        $this->skill = $skill;
        $skill->addUserProjectSkills($this);

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
