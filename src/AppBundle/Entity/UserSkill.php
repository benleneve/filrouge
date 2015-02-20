<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserSkill
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserSkillRepository")
 */
class UserSkill
{

    /**
     * 
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User", inversedBy="userSkills")
     */
    private $user;
    
    /**
     * 
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Skill", inversedBy="userSkills")
     */
    private $skill;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;


    /**
     * Set level
     *
     * @param integer $level
     * @return UserSkill
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }
}
