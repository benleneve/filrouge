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
        
        $projetSkill1 = new ProjectSkill();
        $projetSkill1->setActive(true)
                ->setProject($this->getReference("project4"))
                ->setSkill($this->getReference("skill5"));
        $manager->persist($projetSkill1);
        
        $projetSkill2 = new ProjectSkill();
        $projetSkill2->setActive(false)
                ->setProject($this->getReference("project2"))
                ->setSkill($this->getReference("skill8"));
        $manager->persist($projetSkill2);
        
        $projetSkill3 = new ProjectSkill();
        $projetSkill3->setActive(false)
                ->setProject($this->getReference("project5"))
                ->setSkill($this->getReference("skill20"));
        $manager->persist($projetSkill3);
        
        $projetSkill4 = new ProjectSkill();
        $projetSkill4->setActive(true)
                ->setProject($this->getReference("project4"))
                ->setSkill($this->getReference("skill10"));
        $manager->persist($projetSkill4);
        
        $projetSkill5 = new ProjectSkill();
        $projetSkill5->setActive(true)
                ->setProject($this->getReference("project2"))
                ->setSkill($this->getReference("skill15"));
        $manager->persist($projetSkill5);
        
        $projetSkill6 = new ProjectSkill();
        $projetSkill6->setActive(true)
                ->setProject($this->getReference("project5"))
                ->setSkill($this->getReference("skill13"));
        $manager->persist($projetSkill6);
        
        $projetSkill7 = new ProjectSkill();
        $projetSkill7->setActive(true)
                ->setProject($this->getReference("project4"))
                ->setSkill($this->getReference("skill6"));
        $manager->persist($projetSkill7);
        
        $manager->flush();
    }
    
    public function getORder(){
        
        return 11;
        
    }
    
}

