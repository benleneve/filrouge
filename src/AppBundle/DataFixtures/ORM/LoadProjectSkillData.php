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
                ->setProject($this->getReference("project1"))
                ->setSkill($this->getReference("skill1"))
                ->addApplicants($this->getReference("user4")->getId());
        $manager->persist($projetSkill1);
        
        $projetSkill2 = new ProjectSkill();
        $projetSkill2->setActive(true)
                ->setProject($this->getReference("project1"))
                ->setSkill($this->getReference("skill4"))
                ->addApplicants($this->getReference("user5")->getId());
        $manager->persist($projetSkill2);
        
        $projetSkill3 = new ProjectSkill();
        $projetSkill3->setActive(false)
                ->setProject($this->getReference("project2"))
                ->setSkill($this->getReference("skill5"))
                ->addApplicants($this->getReference("user4")->getId());
        $manager->persist($projetSkill3);
        
        $projetSkill4 = new ProjectSkill();
        $projetSkill4->setActive(false)
                ->setProject($this->getReference("project2"))
                ->setSkill($this->getReference("skill8"))
                ->addApplicants($this->getReference("user3")->getId());
        $manager->persist($projetSkill4);
        
        $projetSkill5 = new ProjectSkill();
        $projetSkill5->setActive(false)
                ->setProject($this->getReference("project2"))
                ->setSkill($this->getReference("skill4"))
                ->addApplicants($this->getReference("user5")->getId());
        $manager->persist($projetSkill5);
        
        $projetSkill6 = new ProjectSkill();
        $projetSkill6->setActive(false)
                ->setProject($this->getReference("project3"))
                ->setSkill($this->getReference("skill1"))
                ->addApplicants($this->getReference("user6")->getId());
        $manager->persist($projetSkill6);
        
        $projetSkill7 = new ProjectSkill();
        $projetSkill7->setActive(false)
                ->setProject($this->getReference("project3"))
                ->setSkill($this->getReference("skill3"))
                ->addApplicants($this->getReference("user5")->getId());
        $manager->persist($projetSkill7);
        
        $projetSkill7 = new ProjectSkill();
        $projetSkill7->setActive(false)
                ->setProject($this->getReference("project3"))
                ->setSkill($this->getReference("skill4"))
                ->addApplicants($this->getReference("user6")->getId());
        $manager->persist($projetSkill7);
        
        $manager->flush();
    }
    
    public function getORder(){
        
        return 11;
        
    }
    
}

