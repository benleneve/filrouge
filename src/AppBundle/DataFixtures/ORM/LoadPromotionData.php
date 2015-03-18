<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Promotion;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPromotionData extends AbstractFixture implements OrderedFixtureInterface {
    
    public function load(ObjectManager $manager) {
        
        $promotion1 = new Promotion();
        $promotion1->setName("DL09")
                   ->setYear(2013)
                   ->setSchool($this->getReference("school1"));
        $manager->persist($promotion1);
        $this->addReference("promotion1", $promotion1);

        $promotion2 = new Promotion();
        $promotion2->setName("CDI10")
                   ->setYear(2014)
                   ->setSchool($this->getReference("school2"));
        $manager->persist($promotion2);
        $this->addReference("promotion2", $promotion2);

        $promotion3 = new Promotion();
        $promotion3->setName("ITS02")
                   ->setYear(2010)
                   ->setSchool($this->getReference("school1"));
        $manager->persist($promotion3);
        $this->addReference("promotion3", $promotion3);

        $promotion4 = new Promotion();
        $promotion4->setName("CDPN12")
                   ->setYear(2015)
                   ->setSchool($this->getReference("school3"));
        $manager->persist($promotion4);
        $this->addReference("promotion4", $promotion4);

        $manager->flush();
    }

    public function getOrder() {
        return 2;
    }
}