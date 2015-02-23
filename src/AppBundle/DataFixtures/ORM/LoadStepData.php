<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Step;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadStepData extends AbstractFixture implements OrderedFixtureInterface {
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
       
        $step1 = new Step();
        $step1->setName('Step 1')
                ->setProject($this->getReference('project1'))
                ->setStatus($this->getReference('status3')); 
        $manager->persist($step1);
        
        $step2 = new Step();
        $step2->setName('Step 2')
                ->setProject($this->getReference('project1'))
                ->setStatus($this->getReference('status3')); 
        $manager->persist($step2);
        
        $step3 = new Step();
        $step3->setName('Step 3')
                ->setProject($this->getReference('project1'))
                ->setStatus($this->getReference('status3')); 
        $manager->persist($step3);
        
        $step4 = new Step();
        $step4->setName('Step 1')
                ->setProject($this->getReference('project3'))
                ->setStatus($this->getReference('status2')); 
        $manager->persist($step4);
        
        $step5 = new Step();
        $step5->setName('Step 2')
                ->setProject($this->getReference('project3'))
                ->setStatus($this->getReference('status1')); 
        $manager->persist($step5);
        
        $step6 = new Step();
        $step6->setName('Step 1')
                ->setProject($this->getReference('project4'))
                ->setStatus($this->getReference('status1')); 
        $manager->persist($step6);
        
        $step7 = new Step();
        $step7->setName('Step 2')
                ->setProject($this->getReference('project4'))
                ->setStatus($this->getReference('status1')); 
        $manager->persist($step7);
        
        $step8 = new Step();
        $step8->setName('Step 1')
                ->setProject($this->getReference('project6'))
                ->setStatus($this->getReference('status3')); 
        $manager->persist($step8);
        
        $step9 = new Step();
        $step9->setName('Step 2')
                ->setProject($this->getReference('project6'))
                ->setStatus($this->getReference('status3')); 
        $manager->persist($step9);
        
        $step10 = new Step();
        $step10->setName('Step 3')
                ->setProject($this->getReference('project6'))
                ->setStatus($this->getReference('status2')); 
        $manager->persist($step10);
        
        $step11 = new Step();
        $step11->setName('Step 4')
                ->setProject($this->getReference('project6'))
                ->setStatus($this->getReference('status1')); 
        $manager->persist($step11);
        
        $step12 = new Step();
        $step12->setName('Step 5')
                ->setProject($this->getReference('project6'))
                ->setStatus($this->getReference('status1')); 
        $manager->persist($step12);
        
        $manager->flush(); 
     
    }
    
    public function getOrder() {
        return 9;
    }
    
}
