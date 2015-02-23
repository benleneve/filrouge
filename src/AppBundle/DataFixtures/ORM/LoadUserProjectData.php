<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\UserProject;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadNotificationData extends AbstractFixture implements OrderedFixtureInterface {
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
       
        $userProject1 = new UserProject();
        $userProject1->setProject($this->getReference('project1'))
                    ->setUser($this->getReference('user2'))
                    ->setSkill('PHP');
        $manager->persist($userProject1);
        
        $userProject2 = new UserProject();
        $userProject2->setProject($this->getReference('project1'))
                    ->setUser($this->getReference('user3'))
                    ->setSkill('Photoshop');
        $manager->persist($userProject2);
        
        $userProject3 = new UserProject();
        $userProject3->setProject($this->getReference('project3'))
                    ->setUser($this->getReference('user9'))
                    ->setSkill('JavaScript');
        $manager->persist($userProject3);
        
        $userProject4 = new UserProject();
        $userProject4->setProject($this->getReference('project6'))
                    ->setUser($this->getReference('user5'))
                    ->setSkill('NodeJS');
        $manager->persist($userProject1);
        
        $userProject5 = new UserProject();
        $userProject5->setProject($this->getReference('project6'))
                    ->setUser($this->getReference('user3'))
                    ->setSkill('Photoshop');
        $manager->persist($userProject1);
        
        $userProject6 = new UserProject();
        $userProject6->setProject($this->getReference('project6'))
                    ->setUser($this->getReference('user6'))
                    ->setSkill('Html5 / CSS3');
        $manager->persist($userProject6);
        
        $userProject7 = new UserProject();
        $userProject7->setProject($this->getReference('project4'))
                    ->setUser($this->getReference('user8'))
                    ->setSkill('PHP');
        $manager->persist($userProject7);
        
        $manager->flush(); 
    }
    
    public function getOrder() {
        return 12;
    }
    
}
