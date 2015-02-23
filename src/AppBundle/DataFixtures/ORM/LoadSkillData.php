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
                ->setCategory($this->getReference('Web'));
        $manager->persist($skill1);
        
        $skill2 = new Skill();
        $skill2->setName('SQL')
                ->setCategory($this->getReference('Web'));
        $manager->persist($skill2);
        
        $skill3 = new Skill();
        $skill3->setName('Java')
                ->setCategory($this->getReference('Web'));
        $manager->persist($skill3);
        
        $skill4 = new Skill();
        $skill4->setName('ASP')
                ->setCategory($this->getReference('Web'));
        $manager->persist($skill4);
        
        $skill5 = new Skill();
        $skill5->setName('C++')
                ->setCategory($this->getReference('Web'));
        $manager->persist($skill5);
        
        $skill6 = new Skill();
        $skill6->setName('HTML')
                ->setCategory($this->getReference('Web'));
        $manager->persist($skill6);
        
        $skill7 = new Skill();
        $skill7->setName('CSS')
                ->setCategory($this->getReference('Web'));
        $manager->persist($skill7);
        
        $skill8 = new Skill();
        $skill8->setName('Javascript')
                ->setCategory($this->getReference('Web'));
        $manager->persist($skill8);
        
        $skill9 = new Skill();
        $skill9->setName('Securite')
                ->setCategory($this->getReference('Reseau'));
        $manager->persist($skill9);
        
        $skill10 = new Skill();
        $skill10->setName('Materiel')
                 ->setCategory($this->getReference('Reseau'));
        $manager->persist($skill10);
        
        $skill11 = new Skill();
        $skill11->setName('Protocole de communication')
                 ->setCategory($this->getReference('Reseau'));
        $manager->persist($skill11);
        
        $skill12 = new Skill();
        $skill12->setName('Windows')
                 ->setCategory($this->getReference('Reseau'));
        $manager->persist($skill12);
        
        $skill13 = new Skill();
        $skill13->setName('Linux')
                 ->setCategory($this->getReference('Reseau'));
        $manager->persist($skill13);
        
        $skill14 = new Skill();
        $skill14->setName('Unix')
                 ->setCategory($this->getReference('Reseau'));
        $manager->persist($skill14);
        
        $skill15 = new Skill();
        $skill15-> setName('Hardware')
                 ->setCategory($this->getReference('Reseau'));
        $manager->persist($skill15);
        
        $skill16 = new Skill();
        $skill16->setName('Wi-Fi')
                 ->setCategory($this->getReference('Reseau'));
        $manager->persist($skill16);
        
        $skill17 = new Skill();
        $skill17->setName('Virtualisation')
                 ->setCategory($this->getReference('Reseau'));
        $manager->persist($skill17);
        
        $skill18 = new Skill();
        $skill18->setName('Routage')
                 ->setCategory($this->getReference('Reseau'));
        $manager->persist($skill18);
        
        $skill19 = new Skill();
        $skill19->setName('Protocoles')
                 ->setCategory($this->getReference('Reseau'));
        $manager->persist($skill19);
        
        $skill20 = new Skill();
        $skill20->setName('Illustrator')
                 ->setCategory($this->getReference('Graphiste'));
        $manager->persist($skill20);
        
        $skill21 = new Skill();
        $skill21->setName('Photoshop')
                 ->setCategory($this->getReference('Graphiste'));
        $manager->persist($skill21);
        
        $skill22 = new Skill();
        $skill22->setName('Xpress')
                 ->setCategory($this->getReference('Graphiste'));
        $manager->persist($skill22);
        
        $manager->flush();
        
        $this->addReference('skill1', $skill1);
        $this->addReference('skill2', $skill2);
        $this->addReference('skill3', $skill3);
        $this->addReference('skill4', $skill4);
        $this->addReference('skill5', $skill5);
        $this->addReference('skill6', $skill6);
        $this->addReference('skill7', $skill7);
        $this->addReference('skill8', $skill8);
        $this->addReference('skill9', $skill9);
        $this->addReference('skill10', $skill10);
        $this->addReference('skill11', $skill11);
        $this->addReference('skill12', $skill12);
        $this->addReference('skill13', $skill13);
        $this->addReference('skill14', $skill14);
        $this->addReference('skill15', $skill15);
        $this->addReference('skill16', $skill16);
        $this->addReference('skill17', $skill17);
        $this->addReference('skill18', $skill18);
        $this->addReference('skill19', $skill19);
        $this->addReference('skill20', $skill20);
        $this->addReference('skill21', $skill21);
        $this->addReference('skill22', $skill22);
    }
    
    public function getOrder() {
        return 6;
    }
}