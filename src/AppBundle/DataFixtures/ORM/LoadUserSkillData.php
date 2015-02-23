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
        
        $level1 = new Level();
        $level1->setLevel('0');
        $manager->persist($level1);
        
        $level2 = new Level();
        $level2->setLevel('1');
        $manager->persist($level2);
        
        $level3 = new Level();
        $level3->setLevel('2');
        $manager->persist($level3);
        
        $level4 = new Level();
        $level4->setLevel('3');
        $manager->persist($level4);
        
        $level5 = new Level();
        $level5->setLevel('4');
        $manager->persist($level5);
        
        $level6 = new Level();
        $level6->setLevel('5');
        $manager->persist($level6);
        
        $manager->flush();
        
    }
    
    public function getOrder(){
        
        return 27;
        
    } 
    
}