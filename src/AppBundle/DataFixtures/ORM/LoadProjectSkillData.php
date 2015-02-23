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
        $active1->setActive(true)
                ->setProject($project4)
                ->setSkill($skill5);
        $manager->persist($active1);
        
        $active2 = new ProjectSkill();
        $active2->setActive(false)
                ->setProject($project2)
                ->setSkill($skill8);
        $manager->persist($active2);
        
        $active3 = new ProjectSkill();
        $active3->setActive(false)
                ->setProject($project5)
                ->setSkill($skill20);
        $manager->persist($active3);
    }
    
    public function getORder(){
        
        return 11;
        
    }
    
}

