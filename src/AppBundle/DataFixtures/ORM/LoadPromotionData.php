<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Promotion;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPromotionData extends AbstractFixtures implements OrderedFixtureInterface
    {
        public function load($manager)
            {
               $promotion1 = new Promotion();
               $promotion1->setName("DL51")
                          ->setYear(2010)
                          ->setSchool($this->getReference("school1"));
               $manager->persist($promotion1);
               $this->addReference("promotion1", $promotion1);
                          
               $promotion2 = new Promotion();
               $promotion2->setName("DL07")
                          ->setYear(2011)
                          ->setSchool($this->getReference("school2"));
               $manager->persist($promotion2);
               $this->addReference("promotion2", $promotion2);
               
               $promotion3 = new Promotion();
               $promotion3->setName("CDI10")
                          ->setYear(2012)
                          ->setSchool($this->getReference("school1"));
               $manager->persist($promotion3);
               $this->addReference("promotion3", $promotion3);
               
               $promotion4 = new Promotion();
               $promotion4->setName("CDI12")
                          ->setYear(2013)
                          ->setSchool($this->getReference("school3"));
               $manager->persist($promotion4);
               $this->addReference("promotion4", $promotion4);
               
               $promotion5 = new Promotion();
               $promotion5->setName("CDPN08")
                          ->setYear(2010)
                          ->setSchool($this->getReference("school3"));
               $manager->persist($promotion5);
               $this->addReference("promotion5", $promotion5);
               
               $promotion6 = new Promotion();
               $promotion6->setName("CDPN09")
                          ->setYear(2011)
                          ->setSchool($this->getReference("school2"));
               $manager->persist($promotion6);
               $this->addReference("promotion6", $promotion6);
               
               $promotion7 = new Promotion();
               $promotion7->setName("DL01")
                          ->setYear(2006)
                          ->setSchool($this->getReference("school1"));
               $manager->persist($promotion7);
               $this->addReference("promotion7", $promotion7);
               
               $promotion8 = new Promotion();
               $promotion8->setName("ITS02")
                          ->setYear(2014)
                          ->setSchool($this->getReference("school1"));
               $manager->persist($promotion8);
               $this->addReference("promotion8", $promotion8);
               
               $promotion9 = new Promotion();
               $promotion9->setName("ITS01")
                          ->setYear(2013)
                          ->setSchool($this->getReference("school2"));
               $manager->persist($promotion9);
               $this->addReference("promotion9", $promotion9);
               
               $promotion10 = new Promotion();
               $promotion10->setName("ITS03")
                          ->setYear(2015)
                          ->setSchool($this->getReference("school3"));
               $manager->persist($promotion10);
               $this->addReference("promotion10", $promotion10);
              
              
               $manager->flush();
            }
         
        public function getOrder() 
            {
                return 2;
            }
    }