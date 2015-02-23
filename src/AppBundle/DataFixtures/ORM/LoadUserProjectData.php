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
       
        $userProject1 = new UserProjectg();
        $userProject1->setProject($this->getReference('project'))
                    ->setUser($this->getReference('user'))
                    ->setSkill();
        $manager->persist($userProject1);
        
        $manager->flush(); 
   
    }
    
    public function getOrder() {
        return 12;
    }
    
}
