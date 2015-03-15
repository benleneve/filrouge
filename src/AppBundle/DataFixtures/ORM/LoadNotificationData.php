<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Notification;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadNotificationData extends AbstractFixture implements OrderedFixtureInterface {
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
       
        $notification1 = new Notification();
        $notification1->setContent('User 8 a créé le projet ')
                        ->setProject($this->getReference('project5'))
                        ->setType(1);
        $manager->persist($notification1);
        
        $notification2 = new Notification();
        $notification2->setContent('User 2 a créé le projet ')
                        ->setProject($this->getReference('project2'))
                        ->setType(1);
        $manager->persist($notification2);
        
        $notification3 = new Notification();
        $notification3->setContent('User 6 a créé le projet ')
                        ->setProject($this->getReference('project4'))
                        ->setType(1);
        $manager->persist($notification3);
        
        $notification4 = new Notification();
        $notification4->setContent('User 10 a rejoint le projet ')
                        ->setProject($this->getReference('project2'))
                        ->setType(2);
        $manager->persist($notification4);
        
        $notification5 = new Notification();
        $notification5->setContent('La compétence PHP a été ajoutée au projet ')
                        ->setProject($this->getReference('project6'))
                        ->setType(3);
        $manager->persist($notification5);
        
        $notification6 = new Notification();
        $notification6->setContent('User 9 a rejoint le projet ')
                        ->setProject($this->getReference('project6'))
                        ->setType(2);
        $manager->persist($notification6);
        
        $notification7 = new Notification();
        $notification7->setContent('La compétence Photoshop a été ajoutée au projet ')
                        ->setProject($this->getReference('project2'))
                        ->setType(3);
        $manager->persist($notification7);
        
        $manager->flush(); 
   
    }
    
    public function getOrder() {
        return 13;
    }
    
}
