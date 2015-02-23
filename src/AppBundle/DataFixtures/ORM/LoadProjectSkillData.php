<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\ProjectSkill;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadProjectSkillData extends AbstractFixture implements OrderedFixtureInterface {
   
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        
        $active1 = new ProjectSkill();
        $active1->setActive(True);
        $manager->persist($active1);
        
        $active2 = new ProjectSkill();
        $active2->setActive(False);
        $manager->persist($active2);
    }
    
    public function getORder(){
        
        return 11;
        
    }
    
}

