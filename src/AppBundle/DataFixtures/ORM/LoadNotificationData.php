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
        $notification1->setContent('Julien a créé le projet ')
                        ->setProject($this->getReference('project3'))
                        ->setType(1);
        $manager->persist($notification1);
        
        $notification2 = new Notification();
        $notification2->setContent('La compétence PHP a été ajoutée au projet ')
                        ->setProject($this->getReference('project3'))
                        ->setType(3);
        $manager->persist($notification2);
        
        $notification3 = new Notification();
        $notification3->setContent('La compétence Javascript a été ajoutée au projet ')
                        ->setProject($this->getReference('project3'))
                        ->setType(3);
        $manager->persist($notification3);
        
        $notification4 = new Notification();
        $notification4->setContent('La compétence HTML5 / CSS3 a été ajoutée au projet ')
                        ->setProject($this->getReference('project3'))
                        ->setType(3);
        $manager->persist($notification4);
        
        $notification5 = new Notification();
        $notification5->setContent('Nicolas a rejoint le projet ')
                        ->setProject($this->getReference('project3'))
                        ->setType(2);
        $manager->persist($notification5);
        
        $notification6 = new Notification();
        $notification6->setContent('Julien a rejoint le projet ')
                        ->setProject($this->getReference('project3'))
                        ->setType(2);
        $manager->persist($notification6);
        
        $notification7 = new Notification();
        $notification7->setContent('Nicolas a rejoint le projet ')
                        ->setProject($this->getReference('project3'))
                        ->setType(2);
        $manager->persist($notification7);
        
        $notification8 = new Notification();
        $notification8->setContent('Marie a créé le projet ')
                        ->setProject($this->getReference('project2'))
                        ->setType(1);
        $manager->persist($notification8);
        
        $notification9 = new Notification();
        $notification9->setContent('La compétence Symfony2 a été ajoutée au projet ')
                        ->setProject($this->getReference('project2'))
                        ->setType(3);
        $manager->persist($notification9);
        
        $notification10 = new Notification();
        $notification10->setContent('La compétence Photoshop a été ajoutée au projet ')
                        ->setProject($this->getReference('project2'))
                        ->setType(3);
        $manager->persist($notification10);
        
        $notification11 = new Notification();
        $notification11->setContent('La compétence HTML5 / CSS3 a été ajoutée au projet ')
                        ->setProject($this->getReference('project2'))
                        ->setType(3);
        $manager->persist($notification11);
        
        $notification12 = new Notification();
        $notification12->setContent('Marie a rejoint le projet ')
                        ->setProject($this->getReference('project2'))
                        ->setType(2);
        $manager->persist($notification12);
        
        $notification13 = new Notification();
        $notification13->setContent('Lena a rejoint le projet ')
                        ->setProject($this->getReference('project2'))
                        ->setType(2);
        $manager->persist($notification13);
        
        $notification14 = new Notification();
        $notification14->setContent('Julien a rejoint le projet ')
                        ->setProject($this->getReference('project2'))
                        ->setType(2);
        $manager->persist($notification14);
        
        $notification15 = new Notification();
        $notification15->setContent('Marie a créé le projet ')
                        ->setProject($this->getReference('project1'))
                        ->setType(1);
        $manager->persist($notification15);
        
        $notification16 = new Notification();
        $notification16->setContent('La compétence PHP a été ajoutée au projet ')
                        ->setProject($this->getReference('project1'))
                        ->setType(2);
        $manager->persist($notification16);
        
        $notification17 = new Notification();
        $notification17->setContent('La compétence HTML5 / CSS3 a été ajoutée au projet ')
                        ->setProject($this->getReference('project1'))
                        ->setType(2);
        $manager->persist($notification17);
        
        $manager->flush(); 
   
    }
    
    public function getOrder() {
        return 13;
    }
    
}
