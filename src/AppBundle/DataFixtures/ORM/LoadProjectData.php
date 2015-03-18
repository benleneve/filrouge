<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Project;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadProjectData extends AbstractFixture implements OrderedFixtureInterface {
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
       
        $project1 = new Project();
        $project1->setName('FilRouge')
                ->setStartDate(new \DateTime('02/20/2015'))
                ->setEndDate(new \DateTime('05/20/2015'))
                ->setPurpose('Réalisation d\'un site de gestion de compétences et de projets pour l\'IMIE')
                ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, '
                        . 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. '
                        . 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. '
                        . 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '
                        . 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.')
                ->setStatus($this->getReference('status1'))
                ->setProjectManager($this->getReference('user1'));
        $manager->persist($project1);
        $this->addReference('project1', $project1);
        
        $project2 = new Project();
        $project2->setName('CinéBlog')
                ->setStartDate(new \DateTime('02/15/2015'))
                ->setEndDate(new \DateTime('04/15/2015'))
                ->setPurpose('Réalisation d\'un blog sur le cinéma')
                ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, '
                        . 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. '
                        . 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. '
                        . 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '
                        . 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.')
                ->setStatus($this->getReference('status2'))
                ->setProjectManager($this->getReference('user2'));
        $manager->persist($project2);
        $this->addReference('project2', $project2);
        
        $project3 = new Project();
        $project3->setName('Geekland')
                ->setStartDate(new \DateTime('01/20/2015'))
                ->setEndDate(new \DateTime('03/15/2015'))
                ->setPurpose('Réalisation d\'une E-boutique d\'accessoires geek')
                ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, '
                        . 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. '
                        . 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. '
                        . 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '
                        . 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.')
                ->setStatus($this->getReference('status3'))
                ->setProjectManager($this->getReference('user4'));
        $manager->persist($project3);
        $this->addReference('project3', $project3);
      
        $manager->flush(); 
    }
    
    public function getOrder() {
        return 8;
    }   
}
