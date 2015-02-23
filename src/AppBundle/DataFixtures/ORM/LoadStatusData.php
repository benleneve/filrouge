<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Status;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadStatusData extends AbstractFixture implements OrderedFixtureInterface {
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
       
        $status1 = new Status();
        $status1->setName('En attente');
        $manager->persist($status1);
        
        $status2 = new Status();
        $status2->setName('En cours');
        $manager->persist($status2);
        
        $status3 = new Status();
        $status3->setName('Terminé');
        $manager->persist($status3);
        
        $manager->flush(); 
        
        $this->addReference('status1', $status1);
        $this->addReference('status2', $status2);
        $this->addReference('status3', $status3);
    }
    
    public function getOrder() {
        return 7;
    }
    
}