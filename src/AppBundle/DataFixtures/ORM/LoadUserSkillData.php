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
        $userSkill1->setLevel('0')
                ->setSkill($this->getReference('skill1'))
                ->setUser($this->getReference('user1'));
        $manager->persist($userSkill1);
        
        $userSkill2 = new UserSkill();
        $userSkill2->setLevel('0')
                ->setSkill($this->getReference('skill6'))
                ->setUser($this->getReference('user2'));
        $manager->persist($userSkill2);
        
        $userSkill3 = new UserSkill();
        $userSkill3->setLevel('0')
                ->setSkill($this->getReference('skill12'))
                ->setUser($this->getReference('user3'));
        $manager->persist($userSkill3);
        
        $userSkill4 = new UserSkill();
        $userSkill4->setLevel('0')
                ->setSkill($this->getReference('skill3'))
                ->setUser($this->getReference('user4'));
        $manager->persist($userSkill4);
        
        $userSkill5 = new UserSkill();
        $userSkill5->setLevel('0')
                ->setSkill($this->getReference('skill22'))
                ->setUser($this->getReference('user5'));
        $manager->persist($userSkill5);
        
        $userSkill6 = new UserSkill();
        $userSkill6->setLevel('0')
                ->setSkill($this->getReference('skill20'))
                ->setUser($this->getReference('user6'));
        $manager->persist($userSkill6);
        
        $manager->flush();
        
    }
    
    public function getOrder(){
        
        return 10;
        
    } 
    
}