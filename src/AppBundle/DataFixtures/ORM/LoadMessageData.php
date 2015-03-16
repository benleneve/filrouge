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
                $message1->setContent(" vous invite à rejoindre le projet ")
                         ->setRecipient($this->getReference("user8"))
                         ->setSender($this->getReference("user1"))
                         ->setType(1)
                         ->setProject($this->getReference("project6"));
                $manager->persist($message1);
                      
                
                $message2 = new Message();
                $message2->setContent("Votre candidature a été acceptée pour le projet ")
                         ->setRecipient($this->getReference("user8"))
                         ->setSender($this->getReference("user5"))
                         ->setType(2)
                         ->setProject($this->getReference("project3"));
                $manager->persist($message2);
                
                $message3 = new Message();
                $message3->setContent("Votre candidature a été refusée pour le projet ")
                         ->setRecipient($this->getReference("user8"))
                         ->setSender($this->getReference("user2"))
                         ->setType(3)
                         ->setProject($this->getReference("project5"));
                $manager->persist($message3);
                
                $message4 = new Message();
                $message4->setContent(" vous invite à rejoindre le projet ")
                         ->setRecipient($this->getReference("user8"))
                         ->setSender($this->getReference("user6"))
                         ->setType(1)
                         ->setProject($this->getReference("project2"));
                $manager->persist($message4);
                
                $message5 = new Message();
                $message5->setContent(" a postulé à votre projet ")
                         ->setRecipient($this->getReference("user8"))
                         ->setSender($this->getReference("user3"))
                         ->setType(1)
                         ->setProject($this->getReference("project1"));
                $manager->persist($message5);
                
                $message6 = new Message();
                $message6->setContent("  a posté un commentaire sur votre projet  ")
                         ->setRecipient($this->getReference("user8"))
                         ->setSender($this->getReference("user3"))
                         ->setType(1)
                         ->setProject($this->getReference("project3"));
                $manager->persist($message6);
                
                $manager->flush();
            }
    
        public function getOrder() 
            {
                return 14;
            }
    }