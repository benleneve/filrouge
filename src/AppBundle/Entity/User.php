<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="UserRepository")
 */
class User
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
     * @ORM\Column(name="firstName", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="birthDate", type="date")
     */
    private $birthDate;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="postCode", type="string", length=255)
     */
    private $postCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var integer
     *
     * @ORM\Column(name="phone", type="integer")
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="availability", type="boolean")
     */
    private $availability;

    /**
     * @var boolean
     *
     * @ORM\Column(name="firstLog", type="boolean")
     */
    private $firstLog;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dispoBirth", type="boolean")
     */
    private $dispoBirth;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dispoEmail", type="boolean")
     */
    private $dispoEmail;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dispoAddress", type="boolean")
     */
    private $dispoAddress;
    
    /**
     * @var Image
     *
     * @ORM\OneToOne(targetEntity="Image")
     */
    private $image;
    
    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="Promotion", mappedBy="users")
     */
    private $promotions;
    
    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Project", mappedBy="projectManager")
     */
    private $managesProjects;
    
    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="UserProject", mappedBy="user")
     */
    private $worksOnProjects;
    
    /**
     * @var array
     * 
     * @ORM\OneToMany(targetEntity="UserSkill", mappedBy="user")
     */
    private $userSkills;
    
    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Message", mappedBy="recipient")
     */
    private $messagesReceived;
    
    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Message", mappedBy="sender")
     */
    private $messagesSent;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->promotions = new ArrayCollection();
        $this->managesProjects = new ArrayCollection();
        $this->worksOnProjects = new ArrayCollection();
        $this->userSkills = new ArrayCollection();
        $this->messagesReceived = new ArrayCollection();
        $this->messagesSent = new ArrayCollection();
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
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set login
     *
     * @param string $login
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set birthDate
     *
     * @param DateTime $birthDate
     * @return User
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return DateTime 
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set postCode
     *
     * @param string $postCode
     * @return User
     */
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * Get postCode
     *
     * @return string 
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return User
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
     * Set availability
     *
     * @param boolean $availability
     * @return User
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;

        return $this;
    }

    /**
     * Get availability
     *
     * @return boolean 
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * Set firstLog
     *
     * @param boolean $firstLog
     * @return User
     */
    public function setFirstLog($firstLog)
    {
        $this->firstLog = $firstLog;

        return $this;
    }

    /**
     * Get firstLog
     *
     * @return boolean 
     */
    public function getFirstLog()
    {
        return $this->firstLog;
    }

    /**
     * Set dispoBirth
     *
     * @param boolean $dispoBirth
     * @return User
     */
    public function setDispoBirth($dispoBirth)
    {
        $this->dispoBirth = $dispoBirth;

        return $this;
    }

    /**
     * Get dispoBirth
     *
     * @return boolean 
     */
    public function getDispoBirth()
    {
        return $this->dispoBirth;
    }

    /**
     * Set dispoEmail
     *
     * @param boolean $dispoEmail
     * @return User
     */
    public function setDispoEmail($dispoEmail)
    {
        $this->dispoEmail = $dispoEmail;

        return $this;
    }

    /**
     * Get dispoEmail
     *
     * @return boolean 
     */
    public function getDispoEmail()
    {
        return $this->dispoEmail;
    }

    /**
     * Set dispoAddress
     *
     * @param boolean $dispoAddress
     * @return User
     */
    public function setDispoAddress($dispoAddress)
    {
        $this->dispoAddress = $dispoAddress;

        return $this;
    }

    /**
     * Get dispoAddress
     *
     * @return boolean 
     */
    public function getDispoAddress()
    {
        return $this->dispoAddress;
    }
    

    /**
     * Set image
     *
     * @param Image $image
     * @return User
     */
    public function setImage(Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return Image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add promotions
     *
     * @param Promotion $promotions
     * @return User
     */
    public function addPromotion(Promotion $promotions)
    {
        $this->promotions[] = $promotions;
        $promotions->addUser($this);

        return $this;
    }

    /**
     * Remove promotions
     *
     * @param Promotion $promotions
     */
    public function removePromotion(Promotion $promotions)
    {
        $this->promotions->removeElement($promotions);
    }

    /**
     * Get promotions
     *
     * @return Collection 
     */
    public function getPromotions()
    {
        return $this->promotions;
    }

    /**
     * Add managesProjects
     *
     * @param Project $managesProjects
     * @return User
     */
    public function addManagesProject(Project $managesProjects)
    {
        $this->managesProjects[] = $managesProjects;

        return $this;
    }

    /**
     * Remove managesProjects
     *
     * @param Project $managesProjects
     */
    public function removeManagesProject(Project $managesProjects)
    {
        $this->managesProjects->removeElement($managesProjects);
    }

    /**
     * Get managesProjects
     *
     * @return Collection 
     */
    public function getManagesProjects()
    {
        return $this->managesProjects;
    }

    /**
     * Add worksOnProjects
     *
     * @param Project $worksOnProjects
     * @return User
     */
    public function addWorksOnProject(Project $worksOnProjects)
    {
        $this->worksOnProjects[] = $worksOnProjects;

        return $this;
    }

    /**
     * Remove worksOnProjects
     *
     * @param Project $worksOnProjects
     */
    public function removeWorksOnProject(Project $worksOnProjects)
    {
        $this->worksOnProjects->removeElement($worksOnProjects);
    }

    /**
     * Get worksOnProjects
     *
     * @return Collection 
     */
    public function getWorksOnProjects()
    {
        return $this->worksOnProjects;
    }

    /**
     * Add userSkills
     *
     * @param UserSkill $userSkills
     * @return User
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
     * Add messagesReceived
     *
     * @param Message $messagesReceived
     * @return User
     */
    public function addMessagesReceived(Message $messagesReceived)
    {
        $this->messagesReceived[] = $messagesReceived;

        return $this;
    }

    /**
     * Remove messagesReceived
     *
     * @param Message $messagesReceived
     */
    public function removeMessagesReceived(Message $messagesReceived)
    {
        $this->messagesReceived->removeElement($messagesReceived);
    }

    /**
     * Get messagesReceived
     *
     * @return Collection 
     */
    public function getMessagesReceived()
    {
        return $this->messagesReceived;
    }

    /**
     * Add messagesSent
     *
     * @param Message $messagesSent
     * @return User
     */
    public function addMessagesSent(Message $messagesSent)
    {
        $this->messagesSent[] = $messagesSent;

        return $this;
    }

    /**
     * Remove messagesSent
     *
     * @param Message $messagesSent
     */
    public function removeMessagesSent(Message $messagesSent)
    {
        $this->messagesSent->removeElement($messagesSent);
    }

    /**
     * Get messagesSent
     *
     * @return Collection 
     */
    public function getMessagesSent()
    {
        return $this->messagesSent;
    }
}
