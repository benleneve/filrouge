<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CategoryRepository")
 */
class Category
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
     * @ORM\OneToMany(targetEntity="Skill", mappedBy="category")
     */
    private $skills;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->skills = new ArrayCollection();
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
     * @return Category
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
     * Add skills
     *
     * @param Skill $skills
     * @return Category
     */
    public function addSkill(Skill $skills)
    {
        $this->skills[] = $skills;

        return $this;
    }

    /**
     * Remove skills
     *
     * @param Skill $skills
     */
    public function removeSkill(Skill $skills)
    {
        $this->skills->removeElement($skills);
    }

    /**
     * Get skills
     *
     * @return Collection 
     */
    public function getSkills()
    {
        return $this->skills;
    }
    

}
