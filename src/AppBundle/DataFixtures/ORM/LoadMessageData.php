<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Message;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMessageData extends AbstractFixture implements OrderedFixtureInterface {
 
    public function load(ObjectManager $manager) {

        $message1 = new Message();
        $message1->setContent(" a postulé à votre projet ")
                 ->setRecipient($this->getReference("user5"))
                 ->setSender($this->getReference("user6"))
                 ->setType(1)
                 ->setProject($this->getReference("project3"));
        $manager->persist($message1);

        $message2 = new Message();
        $message2->setContent("Votre candidature a été acceptée pour le projet ")
                 ->setRecipient($this->getReference("user6"))
                 ->setSender($this->getReference("user5"))
                 ->setType(2)
                 ->setProject($this->getReference("project3"));
        $manager->persist($message2);

        $message3 = new Message();
        $message3->setContent(" a postulé à votre projet ")
                 ->setRecipient($this->getReference("user5"))
                 ->setSender($this->getReference("user5"))
                 ->setType(1)
                 ->setProject($this->getReference("project3"));
        $manager->persist($message3);

        $message4 = new Message();
        $message4->setContent("Votre candidature a été acceptée pour le projet ")
                 ->setRecipient($this->getReference("user5"))
                 ->setSender($this->getReference("user5"))
                 ->setType(2)
                 ->setProject($this->getReference("project3"));
        $manager->persist($message4);

        $message5 = new Message();
        $message5->setContent(" a postulé à votre projet ")
                 ->setRecipient($this->getReference("user5"))
                 ->setSender($this->getReference("user6"))
                 ->setType(1)
                 ->setProject($this->getReference("project3"));
        $manager->persist($message5);

        $message6 = new Message();
        $message6->setContent("Votre candidature a été acceptée pour le projet ")
                 ->setRecipient($this->getReference("user6"))
                 ->setSender($this->getReference("user5"))
                 ->setType(2)
                 ->setProject($this->getReference("project3"));
        $manager->persist($message6);

        $message7 = new Message();
        $message7->setContent(" a postulé à votre projet ")
                 ->setRecipient($this->getReference("user4"))
                 ->setSender($this->getReference("user5"))
                 ->setType(1)
                 ->setProject($this->getReference("project2"));
        $manager->persist($message7);

        $message8 = new Message();
        $message8->setContent("Votre candidature a été acceptée pour le projet ")
                 ->setRecipient($this->getReference("user5"))
                 ->setSender($this->getReference("user4"))
                 ->setType(2)
                 ->setProject($this->getReference("project2"));
        $manager->persist($message8);

        $message9 = new Message();
        $message9->setContent(" a postulé à votre projet ")
                 ->setRecipient($this->getReference("user4"))
                 ->setSender($this->getReference("user3"))
                 ->setType(1)
                 ->setProject($this->getReference("project2"));
        $manager->persist($message9);

        $message10 = new Message();
        $message10->setContent("Votre candidature a été acceptée pour le projet ")
                 ->setRecipient($this->getReference("user3"))
                 ->setSender($this->getReference("user4"))
                 ->setType(2)
                 ->setProject($this->getReference("project2"));
        $manager->persist($message10);

        $message11 = new Message();
        $message11->setContent(" a postulé à votre projet ")
                 ->setRecipient($this->getReference("user4"))
                 ->setSender($this->getReference("user4"))
                 ->setType(1)
                 ->setProject($this->getReference("project2"));
        $manager->persist($message11);

        $message12 = new Message();
        $message12->setContent("Votre candidature a été acceptée pour le projet ")
                 ->setRecipient($this->getReference("user4"))
                 ->setSender($this->getReference("user4"))
                 ->setType(2)
                 ->setProject($this->getReference("project2"));
        $manager->persist($message12);

        $message13 = new Message();
        $message13->setContent(" a postulé à votre projet ")
                 ->setRecipient($this->getReference("user3"))
                 ->setSender($this->getReference("user4"))
                 ->setType(1)
                 ->setProject($this->getReference("project1"));
        $manager->persist($message13);

        $message14 = new Message();
        $message14->setContent(" a posté un commentaire sur votre projet ")
                 ->setRecipient($this->getReference("user5"))
                 ->setSender($this->getReference("user5"))
                 ->setType(1)
                 ->setProject($this->getReference("project3"));
        $manager->persist($message14);

        $message15 = new Message();
        $message15->setContent(" a posté un commentaire sur votre projet ")
                 ->setRecipient($this->getReference("user5"))
                 ->setSender($this->getReference("user6"))
                 ->setType(1)
                 ->setProject($this->getReference("project3"));
        $manager->persist($message15);

        $message16 = new Message();
        $message16->setContent(" a posté un commentaire sur votre projet ")
                 ->setRecipient($this->getReference("user5"))
                 ->setSender($this->getReference("user5"))
                 ->setType(1)
                 ->setProject($this->getReference("project3"));
        $manager->persist($message16);

        $message17 = new Message();
        $message17->setContent(" a posté un commentaire sur votre projet ")
                 ->setRecipient($this->getReference("user4"))
                 ->setSender($this->getReference("user4"))
                 ->setType(1)
                 ->setProject($this->getReference("project2"));
        $manager->persist($message17);

        $message18 = new Message();
        $message18->setContent(" a posté un commentaire sur votre projet ")
                 ->setRecipient($this->getReference("user4"))
                 ->setSender($this->getReference("user3"))
                 ->setType(1)
                 ->setProject($this->getReference("project2"));
        $manager->persist($message18);

        $message19 = new Message();
        $message19->setContent(" a posté un commentaire sur votre projet ")
                 ->setRecipient($this->getReference("user4"))
                 ->setSender($this->getReference("user5"))
                 ->setType(1)
                 ->setProject($this->getReference("project2"));
        $manager->persist($message19);

        $message20 = new Message();
        $message20->setContent(" a postulé à votre projet ")
                 ->setRecipient($this->getReference("user3"))
                 ->setSender($this->getReference("user5"))
                 ->setType(1)
                 ->setProject($this->getReference("project1"));
        $manager->persist($message20);

        $message21 = new Message();
        $message21->setContent("Votre candidature a été refusée pour le projet ")
                 ->setRecipient($this->getReference("user3"))
                 ->setSender($this->getReference("user5"))
                 ->setType(3)
                 ->setProject($this->getReference("project1"));
        $manager->persist($message21);

        $message22 = new Message();
        $message22->setContent(" vous invite à rejoindre le projet ")
                 ->setRecipient($this->getReference("user4"))
                 ->setSender($this->getReference("user3"))
                 ->setType(1)
                 ->setProject($this->getReference("project1"));
        $manager->persist($message22);

        $manager->flush();
    }

    public function getOrder() {
        return 14;
    }
}