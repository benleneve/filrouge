<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Message;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMessageData extends AbstractFixture implements OrderedFixtureInterface 
    {
 
        public function load(ObjectManager $manager) 
            {
                $message1 = new Message();
                $message1->setContent("User1 vous invite à rejoindre le projet 8")
                         ->setRecipient($this->getReference("user8"))
                         ->setSender($this->getReference("user1"))
                         ->setType(1);
                $manager->persist($message1);
                      
                
                $message2 = new Message();
                $message2->setContent("Votre candidature au projet 3 a été acceptée")
                         ->setRecipient($this->getReference("user8"))
                         ->setSender($this->getReference("user5"))
                         ->setType(2);
                $manager->persist($message2);
                
                $message3 = new Message();
                $message3->setContent("Votre candidature au projet 5 a été refusée")
                         ->setRecipient($this->getReference("user8"))
                         ->setSender($this->getReference("user2"))
                         ->setType(3);
                $manager->persist($message3);
                
                $message4 = new Message();
                $message4->setContent("User6 vous invite à rejoindre le projet 2")
                         ->setRecipient($this->getReference("user8"))
                         ->setSender($this->getReference("user6"))
                         ->setType(1);
                $manager->persist($message4);
                
                $message5 = new Message();
                $message5->setContent("User3 vous invite à rejoindre le projet 1")
                         ->setRecipient($this->getReference("user8"))
                         ->setSender($this->getReference("user3"))
                         ->setType(1);
                $manager->persist($message5);
                
                $amanger->flush();
            }
    
        public function getOrder() 
            {
                return 14;
            }
    }