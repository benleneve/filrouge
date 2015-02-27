<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
    {
        public function load(ObjectManager $manager)
            {
                $user1 = new User();
                $user1->setFirstName("Guillaumette")
                      ->setLastName("Dupont")
                      ->setUsername("user1")
                      ->setPassword("userpass")
                      ->setSalt('')
                      ->addRoles('ROLE_USER')
                      ->setBirthDate(new \DateTime())
                      ->setEmail("user1@imie.fr")
                      ->setAddress("25 rue des paquerettes")
                      ->setPostCode("44100")
                      ->setCity("Nantes")
                      ->setPhone("0655478412")
                      ->setDescription("Ouais, salut, c'est Guillaume!")
                      ->setAvailability(true)
                      ->setFirstLog(true)
                      ->setDispoBirth(true)
                      ->setDispoEmail(true)
                      ->setDispoPhone(true)
                      ->setDispoAddress(true)
                      ->setImage($this->getReference("image1"))
                      ->addPromotion($this->getReference("promotion1"));
                $manager->persist($user1);
                $this->addReference("user1", $user1);
                
                
                      
                $user2 = new User();
                $user2->setFirstName("François")
                      ->setLastName("Gérard")
                      ->setUsername("user2")
                      ->setPassword("userpass")
                      ->setSalt('')
                      ->addRoles('ROLE_USER')
                      ->setBirthDate(new \DateTime())
                      ->setEmail("user2@imie.fr")
                      ->setAddress("2 rue des chameaux")
                      ->setPostCode("44200")
                      ->setCity("Nantes")
                      ->setPhone("0658711452")
                      ->setDescription("Ouais, salut, c'est François!")
                      ->setAvailability(false)
                      ->setFirstLog(true)
                      ->setDispoBirth(false)
                      ->setDispoEmail(true)
                      ->setDispoPhone(true)
                      ->setDispoAddress(false)
                      ->setImage($this->getReference("image2"))
                      ->addPromotion($this->getReference("promotion2"));
                $manager->persist($user2);
                $this->addReference("user2", $user2);
                
                
                      
                $user3 = new User();
                $user3->setFirstName("Lena")
                      ->setLastName("Millepattes")
                      ->setUsername("user3")
                      ->setPassword("userpass")
                      ->setSalt('')
                      ->addRoles('ROLE_USER')
                      ->setBirthDate(new \DateTime())
                      ->setEmail("user3@imie.fr")
                      ->setAddress("5 rue Jean Jearès")
                      ->setPostCode("44400")
                      ->setCity("Rezé")
                      ->setPhone("0685412512")
                      ->setDescription("Ouais, salut, c'est Lena!")
                      ->setAvailability(true)
                      ->setFirstLog(false)
                      ->setDispoBirth(true)
                      ->setDispoPhone(false)
                      ->setDispoEmail(false)
                      ->setDispoAddress(true)
                      ->setImage($this->getReference("image3"))
                      ->addPromotion($this->getReference("promotion1"));
                $manager->persist($user3);
                $this->addReference("user3", $user3);
                
                
                      
                $user4 = new User();
                $user4->setFirstName("Marie")
                      ->setLastName("Chirac")
                      ->setUsername("user4")
                      ->setPassword("userpass")
                      ->setSalt('')
                      ->addRoles('ROLE_USER')
                      ->setBirthDate(new \DateTime())
                      ->setEmail("user4@imie.fr")
                      ->setAddress("55 boulevard de la Liberté")
                      ->setPostCode("44100")
                      ->setCity("Nantes")
                      ->setPhone("0688474112")
                      ->setDescription("Ouais, salut, c'est Marie!")
                      ->setAvailability(true)
                      ->setFirstLog(true)
                      ->setDispoBirth(false)
                      ->setDispoPhone(true)
                      ->setDispoEmail(true)
                      ->setDispoAddress(true)
                      ->setImage($this->getReference("image4"))
                      ->addPromotion($this->getReference("promotion3"));
                $manager->persist($user4);
                $this->addReference("user4", $user4);
                
                
                      
                $user5 = new User();
                $user5->setFirstName("Julien")
                      ->setLastName("Strapontin")
                      ->setUsername("user1")
                      ->setPassword("userpass")
                      ->setSalt('')
                      ->addRoles('ROLE_USER')
                      ->setBirthDate(new \DateTime())
                      ->setEmail("user5@imie.fr")
                      ->setAddress("47 rue des petites canailles")
                      ->setPostCode("44800")
                      ->setCity("Saint-Herblain")
                      ->setPhone("0687414522")
                      ->setDescription("Ouais, salut, c'est Julien!")
                      ->setAvailability(true)
                      ->setFirstLog(true)
                      ->setDispoBirth(false)
                      ->setDispoPhone(false)
                      ->setDispoEmail(true)
                      ->setDispoAddress(false)
                      ->setImage($this->getReference("image5"))
                      ->addPromotion($this->getReference("promotion6"));
                $manager->persist($user5);
                $this->addReference("user5", $user5);
                
                
                      
                $user6 = new User();
                $user6->setFirstName("Basile")
                      ->setLastName("L'Agile")
                      ->setUsername("user6")
                      ->setPassword("userpass")
                      ->setSalt('')
                      ->addRoles('ROLE_USER')
                      ->setBirthDate(new \DateTime())
                      ->setEmail("user6@imie.fr")
                      ->setAddress("125 rue des paquerettes")
                      ->setPostCode("44100")
                      ->setCity("Nantes")
                      ->setPhone("0687956321")
                      ->setDescription("Ouais, salut, c'est Basile!")
                      ->setAvailability(true)
                      ->setFirstLog(true)
                      ->setDispoBirth(false)
                      ->setDispoPhone(true)
                      ->setDispoEmail(false)
                      ->setDispoAddress(false)
                      ->setImage($this->getReference("image6"))
                      ->addPromotion($this->getReference("promotion8"));
                $manager->persist($user6);
                $this->addReference("user6", $user6);
                
                
                      
                $user7 = new User();
                $user7->setFirstName("Alexandre")
                      ->setLastName("Le Petit")
                      ->setUsername("user7")
                      ->setPassword("userpass")
                      ->setSalt('')
                      ->addRoles('ROLE_USER')
                      ->setBirthDate(new \DateTime())
                      ->setEmail("user7@imie.fr")
                      ->setAddress("25 rue de la Madeleine")
                      ->setPostCode("44300")
                      ->setCity("Nantes")
                      ->setPhone("0687459874")
                      ->setDescription("Ouais, salut, c'est Alex!")
                      ->setAvailability(true)
                      ->setFirstLog(true)
                      ->setDispoBirth(true)
                      ->setDispoPhone(false)
                      ->setDispoEmail(true)
                      ->setDispoAddress(true)
                      ->setImage($this->getReference("image7"))
                      ->addPromotion($this->getReference("promotion9"));
                $manager->persist($user7);
                $this->addReference("user7", $user7);
                
                
                      
                $user8 = new User();
                $user8->setFirstName("Mickael")
                      ->setLastName("Heineken")
                      ->setUsername("user8")
                      ->setPassword("userpass")
                      ->setSalt('')
                      ->addRoles('ROLE_USER')
                      ->setBirthDate(new \DateTime())
                      ->setEmail("user8@imie.fr")
                      ->setAddress("25 allée des patates douces")
                      ->setPostCode("44230")
                      ->setCity("Saint-Sebastien-sur-Loire")
                      ->setPhone("0622147525")
                      ->setDescription("Ouais, salut, c'est Micka!")
                      ->setAvailability(true)
                      ->setFirstLog(true)
                      ->setDispoBirth(false)
                      ->setDispoPhone(true)
                      ->setDispoEmail(true)
                      ->setDispoAddress(true)
                      ->setImage($this->getReference("image8"))
                      ->addPromotion($this->getReference("promotion10"));
                $manager->persist($user8);
                $this->addReference("user8", $user8);
                
                
                      
                $user9 = new User();
                $user9->setFirstName("Cloé")
                      ->setLastName("Lapin")
                      ->setUsername("user9")
                      ->setPassword("userpass")
                      ->setSalt('')
                      ->addRoles('ROLE_USER')
                      ->setBirthDate(new \DateTime())
                      ->setEmail("user9@imie.fr")
                      ->setAddress("25 rue de la gare")
                      ->setPostCode("49000")
                      ->setCity("Angers")
                      ->setPhone("0677854712")
                      ->setDescription("Ouais, salut, c'est Cloé!")
                      ->setAvailability(true)
                      ->setFirstLog(true)
                      ->setDispoBirth(true)
                      ->setDispoPhone(false)
                      ->setDispoEmail(true)
                      ->setDispoAddress(true)
                      ->setImage($this->getReference("image9"))
                      ->addPromotion($this->getReference("promotion6"));
                $manager->persist($user9);
                $this->addReference("user9", $user9);
                
                
                      
                $user10 = new User();
                $user10->setFirstName("Elise")
                      ->setLastName("Reglisse")
                      ->setUsername("user10")
                      ->setPassword("userpass")
                      ->setSalt('')
                      ->addRoles('ROLE_USER')
                      ->setBirthDate(new \DateTime())
                      ->setEmail("user10@imie.fr")
                      ->setAddress("32 route des Schtroumpfs")
                      ->setPostCode("35000")
                      ->setCity("Rennes")
                      ->setPhone("0685749652")
                      ->setDescription("Ouais, salut, c'est Elise!")
                      ->setAvailability(true)
                      ->setFirstLog(true)
                      ->setDispoBirth(true)
                      ->setDispoPhone(true)
                      ->setDispoEmail(true)
                      ->setDispoAddress(true)
                      ->setImage($this->getReference("image10"))
                      ->addPromotion($this->getReference("promotion10"));
                $manager->persist($user10);
                $this->addReference("user10", $user10);
                
                
                      
                $user11 = new User();
                $user11->setFirstName("Charline")
                      ->setLastName("La Maline")
                      ->setUsername("user")
                      ->setPassword("userpass")
                      ->setSalt('')
                      ->addRoles('ROLE_USER')
                      ->setBirthDate(new \DateTime())
                      ->setEmail("user11@imie.fr")
                      ->setAddress("125 boulevard des Cracottes")
                      ->setPostCode("44100")
                      ->setCity("Nantes")
                      ->setPhone("0785412562")
                      ->setDescription("Ouais, salut, c'est Charline!")
                      ->setAvailability(true)
                      ->setFirstLog(true)
                      ->setDispoPhone(true)
                      ->setDispoBirth(true)
                      ->setDispoEmail(true)
                      ->setDispoAddress(true)
                      ->setImage($this->getReference("image11"))
                      ->addPromotion($this->getReference("promotion10"));
                $manager->persist($user11);
                $this->addReference("user11", $user11);
                
                $user12 = new User();
                $user12->setFirstName("Karina")
                      ->setLastName("Prel")
                      ->setUsername("admin")
                      ->setPassword("adminpass")
                      ->setSalt('')
                      ->addRoles('ROLE_ADMIN')
                      ->setBirthDate(new \DateTime())
                      ->setEmail("user12@imie.fr")
                      ->setAddress("120 boulevard des Cracottes")
                      ->setPostCode("44100")
                      ->setCity("Nantes")
                      ->setPhone("0618754252")
                      ->setDescription("Ouais, salut, c'est Karina!")
                      ->setAvailability(true)
                      ->setFirstLog(true)
                      ->setDispoBirth(true)
                      ->setDispoPhone(false)
                      ->setDispoEmail(true)
                      ->setDispoAddress(true);
                $manager->persist($user12);
                $this->addReference("user12", $user12);
                
                $manager->flush();
                      
            }
         
        public function getOrder() 
            {
                return 4;
            }
    }
