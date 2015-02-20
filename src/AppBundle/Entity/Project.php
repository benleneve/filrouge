<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ProjectRepository")
 */
class Project
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
     * @var DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="startDate", type="date")
     */
    private $startDate;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="endDate", type="date")
     */
    private $endDate;

    /**
     * @var string
     *
     * @ORM\Column(name="purpose", type="string", length=255)
     */
    private $purpose;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    
    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="managesProjects")
     */
    private $projectManager;
    
    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="User", inversedBy="worksOnProjects")
     */
    private $projectMembers;
    
    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Step", mappedBy="project", cascade={"remove"})
     */
    private $steps;
    
    /**
     * @var Status
     *
     * @ORM\ManyToOne(targetEntity="Status", inversedBy="projects")
     */
    private $status;
    
    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="Skill", mappedBy="projects")
     */
    private $skills;
    
    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Notification", mappedBy="project")
     */
    private $notifications;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->projectMembers = new ArrayCollection();
        $this->steps = new ArrayCollection();
        $this->skills = new ArrayCollection();
        $this->notifications = new ArrayCollection();
        $this->creationDate = new DateTime();
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
     * Set creationDate
     *
     * @param DateTime $creationDate
     * @return Notification
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return DateTime 
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Project
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
     * Set startDate
     *
     * @param DateTime $startDate
     * @return Project
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param DateTime $endDate
     * @return Project
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set purpose
     *
     * @param string $purpose
     * @return Project
     */
    public function setPurpose($purpose)
    {
        $this->purpose = $purpose;

        return $this;
    }

    /**
     * Get purpose
     *
     * @return string 
     */
    public function getPurpose()
    {
        return $this->purpose;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * Set projectManager
     *
     * @param User $projectManager
     * @return Project
     */
    public function setProjectManager(User $projectManager = null)
    {
        $this->projectManager = $projectManager;

        return $this;
    }

    /**
     * Get projectManager
     *
     * @return User 
     */
    public function getProjectManager()
    {
        return $this->projectManager;
    }

    /**
     * Add projectMembers
     *
     * @param User $projectMembers
     * @return Project
     */
    public function addProjectMember(User $projectMembers)
    {
        $this->projectMembers[] = $projectMembers;

        return $this;
    }

    /**
     * Remove projectMembers
     *
     * @param User $projectMembers
     */
    public function removeProjectMember(User $projectMembers)
    {
        $this->projectMembers->removeElement($projectMembers);
    }

    /**
     * Get projectMembers
     *
     * @return Collection 
     */
    public function getProjectMembers()
    {
        return $this->projectMembers;
    }

    /**
     * Add steps
     *
     * @param Step $steps
     * @return Project
     */
    public function addStep(Step $steps)
    {
        $this->steps[] = $steps;

        return $this;
    }

    /**
     * Remove steps
     *
     * @param Step $steps
     */
    public function removeStep(Step $steps)
    {
        $this->steps->removeElement($steps);
    }

    /**
     * Get steps
     *
     * @return Collection 
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * Set status
     *
     * @param Status $status
     * @return Project
     */
    public function setStatus(Status $status = null)
    {
        $this->status = $status;

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

    /**
     * Add skills
     *
     * @param Skill $skills
     * @return Project
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

    /**
     * Add notifications
     *
     * @param Notification $notifications
     * @return Project
     */
    public function addNotification(Notification $notifications)
    {
        $this->notifications[] = $notifications;

        return $this;
    }

    /**
     * Remove notifications
     *
     * @param Notification $notifications
     */
    public function removeNotification(Notification $notifications)
    {
        $this->notifications->removeElement($notifications);
    }

    /**
     * Get notifications
     *
     * @return Collection 
     */
    public function getNotifications()
    {
        return $this->notifications;
    }
}
