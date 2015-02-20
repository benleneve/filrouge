<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Skill
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SkillRepository")
 */
class Skill
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
     * @var array
     * 
     * @ORM\OneToMany(targetEntity="UserSkill", mappedBy="skill")
     */
    private $userSkills;
    
    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="Project", inversedBy="skills")
     */
    private $projects;
    
    /**
     * @var Category
     * 
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="skills")
     */
    private $category;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userSkills = new ArrayCollection();
        $this->projects = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Skill
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
     * Add userSkills
     *
     * @param UserSkill $userSkills
     * @return Skill
     */
    public function addUserSkill(UserSkill $userSkills)
    {
        $this->userSkills[] = $userSkills;

        return $this;
    }

    /**
     * Remove userSkills
     *
     * @param UserSkill $userSkills
     */
    public function removeUserSkill(UserSkill $userSkills)
    {
        $this->userSkills->removeElement($userSkills);
    }

    /**
     * Get userSkills
     *
     * @return Collection 
     */
    public function getUserSkills()
    {
        return $this->userSkills;
    }

    /**
     * Add projects
     *
     * @param Project $projects
     * @return Skill
     */
    public function addProject(Project $projects)
    {
        $this->projects[] = $projects;

        return $this;
    }

    /**
     * Remove projects
     *
     * @param Project $projects
     */
    public function removeProject(Project $projects)
    {
        $this->projects->removeElement($projects);
    }

    /**
     * Get projects
     *
     * @return Collection 
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * Set category
     *
     * @param Category $category
     * @return Skill
     */
    public function setCategory(Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
