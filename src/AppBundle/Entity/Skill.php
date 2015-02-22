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
     * @ORM\OneToMany(targetEntity="ProjectSkill", mappedBy="skill")
     */
    private $projectSkills;
    
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
        $this->projectSkills = new ArrayCollection();
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
     * Add projectSkills
     *
     * @param ProjectSkill $projectSkills
     * @return Skill
     */
    public function addProjectSkills(ProjectSkill $projectSkills)
    {
        $this->projectSkills[] = $projectSkills;

        return $this;
    }

    /**
     * Remove projectSkills
     *
     * @param ProjectSkill $projectSkills
     */
    public function removeProjectSkill(ProjectSkill $projectSkills)
    {
        $this->projectSkills->removeElement($projectSkills);
    }

    /**
     * Get projectSkills
     *
     * @return Collection 
     */
    public function getProjectSkills()
    {
        return $this->projectSkills;
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
        $category->addSkill($this);

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
