<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\UserSkill;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserSkillData extends AbstractFixture implements OrderedFixtureInterface {
   
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        
        $userSkill1 = new UserSkill();
        $userSkill1->setLevel('4')
                ->setSkill($this->getReference('skill8'))
                ->setUser($this->getReference('user3'));
        $manager->persist($userSkill1);
        
        $userSkill2 = new UserSkill();
        $userSkill2->setLevel('3')
                ->setSkill($this->getReference('skill9'))
                ->setUser($this->getReference('user3'));
        $manager->persist($userSkill2);
        
        $userSkill3 = new UserSkill();
        $userSkill3->setLevel('5')
                ->setSkill($this->getReference('skill10'))
                ->setUser($this->getReference('user3'));
        $manager->persist($userSkill3);
        
        $userSkill4 = new UserSkill();
        $userSkill4->setLevel('4')
                ->setSkill($this->getReference('skill1'))
                ->setUser($this->getReference('user4'));
        $manager->persist($userSkill4);
        
        $userSkill5 = new UserSkill();
        $userSkill5->setLevel('4')
                ->setSkill($this->getReference('skill5'))
                ->setUser($this->getReference('user4'));
        $manager->persist($userSkill5);
        
        $userSkill6 = new UserSkill();
        $userSkill6->setLevel('2')
                ->setSkill($this->getReference('skill6'))
                ->setUser($this->getReference('user4'));
        $manager->persist($userSkill6);
        
        $userSkill7 = new UserSkill();
        $userSkill7->setLevel('4')
                ->setSkill($this->getReference('skill3'))
                ->setUser($this->getReference('user5'));
        $manager->persist($userSkill7);
        
        $userSkill8 = new UserSkill();
        $userSkill8->setLevel('5')
                ->setSkill($this->getReference('skill4'))
                ->setUser($this->getReference('user5'));
        $manager->persist($userSkill8);
        
        $userSkill9 = new UserSkill();
        $userSkill9->setLevel('3')
                ->setSkill($this->getReference('skill1'))
                ->setUser($this->getReference('user6'));
        $manager->persist($userSkill9);
        
        $userSkill10 = new UserSkill();
        $userSkill10->setLevel('3')
                ->setSkill($this->getReference('skill3'))
                ->setUser($this->getReference('user6'));
        $manager->persist($userSkill10);
        
        $userSkill11 = new UserSkill();
        $userSkill11->setLevel('1')
                ->setSkill($this->getReference('skill4'))
                ->setUser($this->getReference('user6'));
        $manager->persist($userSkill11);
        
        $userSkill12 = new UserSkill();
        $userSkill12->setLevel('3')
                ->setSkill($this->getReference('skill5'))
                ->setUser($this->getReference('user6'));
        $manager->persist($userSkill12);
        
        $manager->flush();
        
    }
    
    public function getOrder(){
        
        return 10;
        
    } 
    
}