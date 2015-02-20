<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * School
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SchoolRepository")
 */
class School
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
     * @ORM\OneToMany(targetEntity="Promotion", mappedBy="school")
     */
    private $promotions;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->promotions = new ArrayCollection();
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
     * @return School
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
     * Add promotions
     *
     * @param Promotion $promotions
     * @return School
     */
    public function addPromotion(Promotion $promotions)
    {
        $this->promotions[] = $promotions;

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
}
