<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Image;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadImageData extends AbstractFixture implements OrderedFixtureInterface {
    
    public function load(ObjectManager $manager) {
        
        $image1 = new Image();
        $image1->setUrl("bundles/app/images/avatar.png")
                ->setAlt("Image du profil");
        $manager->persist($image1);
        $this->addReference("image1", $image1);

        $image2 = new Image();
        $image2->setUrl("http://www.amha.fr/wp-content/uploads/2008/10/geek.jpg")
                ->setAlt("Image de profil");
        $manager->persist($image2);
        $this->addReference("image2", $image2);

        $image3 = new Image();
        $image3->setUrl("http://les-tribulations-dune-aspergirl.com/wp-content/uploads/2013/12/miss-geek.jpg")
                ->setAlt("Image de profil");
        $manager->persist($image3);
        $this->addReference("image3", $image3);

        $image4 = new Image();
        $image4->setUrl("http://last48hours.com/wp-content/uploads/2012/12/geek2.jpg")
                ->setAlt("Image de profil");
        $manager->persist($image4);
        $this->addReference("image4", $image4);

        $image5 = new Image();
        $image5->setUrl("http://lacigaleoulafourmi.com/wp-content/uploads/2014/04/ppc-geek.jpg")
                ->setAlt("Image de profil");
        $manager->persist($image5);
        $this->addReference("image5", $image5);

        $manager->flush();           
    }

    public function getOrder() {
        return 3;
    }
}