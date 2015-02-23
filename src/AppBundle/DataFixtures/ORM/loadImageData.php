<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Image;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadImageData extends AbstractFixtures implements OrderedFixtureInterface
    {
        public function load($manager)
            {
                $image1 = new Image();
                $image1->setUrl("http://www.journaldugeek.com/files/2014/01/mr-geek-600x356.jpg")
                        ->setAlt("Image de profil");
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
                
                
                $image6 = new Image();
                $image6->setUrl("http://www.lolchat.fr/wp-content/uploads/2014/02/chat-derriere-ordinateur-geek.jpg")
                        ->setAlt("Image de profil");
                $manager->persist($image6);
                $this->addReference("image6", $image6);
                
                
                $image7 = new Image();
                $image7->setUrl("http://static02.mediaite.com/themarysue/uploads/2012/05/Geek.jpg")
                        ->setAlt("Image de profil");
                $manager->persist($image7);
                $this->addReference("image7", $image7);
                
                
                $image8 = new Image();
                $image8->setUrl("http://fc09.deviantart.net/fs71/f/2010/232/7/d/Got_Geek__by_shademan55.gif")
                        ->setAlt("Image de profil");
                $manager->persist($image8);
                $this->addReference("image8", $image8);
                
                
                $image9 = new Image();
                $image9->setUrl("http://static.fjcdn.com/pictures/Cute+geek+baby_b8cbbd_4250101.jpg")
                        ->setAlt("Image de profil");
                $manager->persist($image9);
                $this->addReference("image9", $image9);
                
                
                $image10 = new Image();
                $image10->setUrl("http://siliconangle.com/files/2012/02/super-nerd.jpg")
                        ->setAlt("Image de profil");
                $manager->persist($image10);
                $this->addReference("image10", $image10);
                
                
                $image11 = new Image();
                $image11->setUrl("http://fc06.deviantart.net/fs51/i/2009/298/5/b/Nerd_Love_by_mescal.jpg")
                        ->setAlt("Image de profil");
                $manager->persist($image11);
                $this->addReference("image11", $image11);
                
                
                $image12 = new Image();
                $image12->setUrl("http://static.hothdwallpaper.net/51b0e11acb46d94306.jpg")
                        ->setAlt("Image de profil");
                $manager->persist($image12);
                $this->addReference("image12", $image12);
                
                
                $image13 = new Image();
                $image13->setUrl("https://tickrnews.files.wordpress.com/2013/08/1009461_682296641783711_1680170072_o.jpg")
                        ->setAlt("Image de profil");
                $manager->persist($image13);
                $this->addReference("image13", $image13);
                
                
                $image14 = new Image();
                $image14->setUrl("http://premium.wpmudev.org/blog/wp-content/uploads/2012/10/wordpress-plugin-coding-standards-300x203.jpg")
                        ->setAlt("Image de profil");
                $manager->persist($image14);
                $this->addReference("image14", $image14);
                
                $manager->flush();
          
                        
            }
         
        public function getOrder() 
            {
                return 3;
            }
    }