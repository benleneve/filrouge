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

        $notification8 = new Notification();
        $notification8->setContent('CHIRAC Marie a créé le projet ')
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
        $notification11->setContent('La compétence HTML5-CSS3 a été ajoutée au projet ')
                        ->setProject($this->getReference('project2'))
                        ->setType(3);
        $manager->persist($notification11);
        
        $notification12 = new Notification();
        $notification12->setContent('CHIRAC Marie a rejoint le projet ')
                        ->setProject($this->getReference('project2'))
                        ->setType(2);
        $manager->persist($notification12);
        
        $notification13 = new Notification();
        $notification13->setContent('MILLEPATTES Lena a rejoint le projet ')
                        ->setProject($this->getReference('project2'))
                        ->setType(2);
        $manager->persist($notification13);
        
        $notification14 = new Notification();
        $notification14->setContent('STRAPONTIN Julien a rejoint le projet ')
                        ->setProject($this->getReference('project2'))
                        ->setType(2);
        $manager->persist($notification14);
        
        $notification15 = new Notification();
        $notification15->setContent('CHIRAC Marie a créé le projet ')
                        ->setProject($this->getReference('project1'))
                        ->setType(1);
        $manager->persist($notification15);
        
        $notification16 = new Notification();
        $notification16->setContent('La compétence PHP a été ajoutée au projet ')
                        ->setProject($this->getReference('project1'))
                        ->setType(2);
        $manager->persist($notification16);
        
        $notification17 = new Notification();
        $notification17->setContent('La compétence HTML5-CSS3 a été ajoutée au projet ')
                        ->setProject($this->getReference('project1'))
                        ->setType(2);
        $manager->persist($notification17);
        
        $manager->flush(); 
   
    }
    
    public function getOrder() {
        return 13;
    }
    
}
