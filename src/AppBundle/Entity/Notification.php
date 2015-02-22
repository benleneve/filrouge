<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="NotificationRepository")
 */
class Notification
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
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;
    
    /**
     * @var Project
     *
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="notifications")
     */
    private $project;
    
    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="User", mappedBy="notifications")
     */
    private $users;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
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
     * Set content
     *
     * @param string $content
     * @return Notification
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Notification
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * Set project
     *
     * @param Project $project
     * @return Notification
     */
    public function setProject(Project $project = null)
    {
        $this->project = $project;
        $project->addNotification($this);

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
     * Add users
     *
     * @param User $users
     * @return Notification
     */
    public function addUser(User $users)
    {
        $this->users[] = $users;
        $users->addNotification($this);

        return $this;
    }

    /**
     * Remove users
     *
     * @param User $users
     */
    public function removeUser(User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
