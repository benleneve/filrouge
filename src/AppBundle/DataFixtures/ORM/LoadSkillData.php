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
        
        $this->addReference('PHP', $skill1);
        $this->addReference('SQL', $skill2);
        $this->addReference('Java', $skill3);
        $this->addReference('ASP', $skill4);
        $this->addReference('C++', $skill5);
        $this->addReference('HTML', $skill6);
        $this->addReference('CSS', $skill7);
        $this->addReference('Javascript', $skill8);
        $this->addReference('Securite', $skill9);
        $this->addReference('Materiel', $skill10);
        $this->addReference('Protocole de communication', $skill11);
        $this->addReference('Windows', $skill12);
        $this->addReference('Linux', $skill13);
        $this->addReference('Unix', $skill14);
        $this->addReference('Hardware', $skill15);
        $this->addReference('Wi-Fi', $skill16);
        $this->addReference('Virtualisation', $skill17);
        $this->addReference('Routage', $skill18);
        $this->addReference('Protocoles', $skill19);
        $this->addReference('Illustrator', $skill20);
        $this->addReference('Photoshop', $skill21);
        $this->addReference('Xpress', $skill22);
    }
    
    public function getOrder() {
        return 6;
    }
}