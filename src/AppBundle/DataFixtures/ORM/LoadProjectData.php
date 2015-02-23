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
        $project1->setName('Project 1')
                ->setStartDate(new \DateTime())
                ->setEndDate(new \DateTime())
                ->setPurpose('L\'objectif du project 1')
                ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, '
                        . 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. '
                        . 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. '
                        . 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '
                        . 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.')
                ->setStatus($this->getReference('status3'))
                ->setProjectManager($this->getReference('user1'));
        $manager->persist($project1);
        
        $project2 = new Project();
        $project2->setName('Project 2')
                ->setStartDate(new \DateTime())
                ->setEndDate(new \DateTime())
                ->setPurpose('L\'objectif du project 2')
                ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, '
                        . 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. '
                        . 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. '
                        . 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '
                        . 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.')
                ->setStatus($this->getReference('status1'))
                ->setProjectManager($this->getReference('user2'));
        $manager->persist($project2);
        
        $project3 = new Project();
        $project3->setName('Project 3')
                ->setStartDate(new \DateTime())
                ->setEndDate(new \DateTime())
                ->setPurpose('L\'objectif du project 3')
                ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, '
                        . 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. '
                        . 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. '
                        . 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '
                        . 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.')
                ->setStatus($this->getReference('status2'))
                ->setProjectManager($this->getReference('user4'));
        $manager->persist($project3);
        
        $project4 = new Project();
        $project4->setName('Project 4')
                ->setStartDate(new \DateTime())
                ->setEndDate(new \DateTime())
                ->setPurpose('L\'objectif du project 4')
                ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, '
                        . 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. '
                        . 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. '
                        . 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '
                        . 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.')
                ->setStatus($this->getReference('status1'))
                ->setProjectManager($this->getReference('user6'));
        $manager->persist($project4);
        
        $project5 = new Project();
        $project5->setName('Project 5')
                ->setStartDate(new \DateTime())
                ->setEndDate(new \DateTime())
                ->setPurpose('L\'objectif du project 5')
                ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, '
                        . 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. '
                        . 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. '
                        . 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '
                        . 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.')
                ->setStatus($this->getReference('status1'))
                ->setProjectManager($this->getReference('user8'));
        $manager->persist($project5);
        
        $project6 = new Project();
        $project6->setName('Project 6')
                ->setStartDate(new \DateTime())
                ->setEndDate(new \DateTime())
                ->setPurpose('L\'objectif du project 6')
                ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, '
                        . 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. '
                        . 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. '
                        . 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '
                        . 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.')
                ->setStatus($this->getReference('status2'))
                ->setProjectManager($this->getReference('user6'));
        $manager->persist($project6);
        
        $manager->flush(); 
        
        $this->addReference('project1', $project1);
        $this->addReference('project2', $project2);
        $this->addReference('project3', $project3);
        $this->addReference('project4', $project4);
        $this->addReference('project5', $project5);
        $this->addReference('project6', $project6);
    }
    
    public function getOrder() {
        return 8;
    }
    
}
