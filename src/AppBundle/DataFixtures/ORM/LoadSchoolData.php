<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\School;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSchoolData extends AbstractFixtures implements OrderedFixtureInterface
    {
        public function load($manager)
            {
                $school1 = new School();
                $school1->setName("Nantes");
                $manager->persist($school1);
                $this->addReference("school1", $school1);
               
                
                $school2 = new School();
                $school2->setName("Angers");
                $manager->persist($school2);
                $this->addReference("school2", $school2);
               
                
                $school3 = new School();
                $school3->setName("Rennes");
                $manager->persist($school3);
                $this->addReference("school3", $school3);
            
                $manager->flush();
            }
         
        public function getOrder() 
            {
                return 1;
            }
    }

