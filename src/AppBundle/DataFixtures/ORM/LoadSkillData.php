<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Skill;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSkillData extends AbstractFixture implements OrderedFixtureInterface {
   
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        
        $skill1 = new Skill();
        $skill1->setName('PHP')
                ->setCategory($this->getReference('category1'));
        $manager->persist($skill1);
        $this->addReference('skill1', $skill1);
        
        $skill2 = new Skill();
        $skill2->setName('Java')
                ->setCategory($this->getReference('category1'));
        $manager->persist($skill2);
        $this->addReference('skill2', $skill2);
        
        $skill3 = new Skill();
        $skill3->setName('Javascript')
                ->setCategory($this->getReference('category1'));
        $manager->persist($skill3);
        $this->addReference('skill3', $skill3);
        
        $skill4 = new Skill();
        $skill4->setName('HTML5-CSS3')
                ->setCategory($this->getReference('category1'));
        $manager->persist($skill4);
        $this->addReference('skill4', $skill4);
        
        $skill5 = new Skill();
        $skill5->setName('Symfony2')
                ->setCategory($this->getReference('category2'));
        $manager->persist($skill5);
        $this->addReference('skill5', $skill5);
        
        $skill6 = new Skill();
        $skill6->setName('Zend Framework')
                ->setCategory($this->getReference('category2'));
        $manager->persist($skill6);
        $this->addReference('skill6', $skill6);
        
        $skill7 = new Skill();
        $skill7->setName('CakePHP')
                ->setCategory($this->getReference('category2'));
        $manager->persist($skill7);
        $this->addReference('skill7', $skill7);
        
        $skill8 = new Skill();
        $skill8->setName('Photoshop')
                ->setCategory($this->getReference('category3'));
        $manager->persist($skill8);
        $this->addReference('skill8', $skill8);
        
        $skill9 = new Skill();
        $skill9->setName('Illustrator')
                ->setCategory($this->getReference('category3'));
        $manager->persist($skill9);
        $this->addReference('skill9', $skill9);
        
        $skill10 = new Skill();
        $skill10->setName('InDesign')
                 ->setCategory($this->getReference('category3'));
        $manager->persist($skill10);
        $this->addReference('skill10', $skill10);

        $manager->flush();    
    }
    
    public function getOrder() {
        return 6;
    }
}