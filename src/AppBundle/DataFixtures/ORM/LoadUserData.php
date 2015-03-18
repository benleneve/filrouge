<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface {
       
    public function load(ObjectManager $manager) {
        
        $user1 = new User();
        $user1->setFirstName("Alexandre")
              ->setLastName("ALBRESPY")
              ->setUsername("superadmin")
              ->setPassword("superadminpass")
              ->setSalt('')
              ->addRoles('ROLE_SUPER_ADMIN')
              ->setBirthDate(new \DateTime('04/06/1978'))
              ->setEmail("alexandre.albrespy@imie.fr")
              ->setAddress("25 rue des paquerettes")
              ->setPostCode("44100")
              ->setCity("Nantes")
              ->setPhone("0655478412")
              ->setDescription("Bonjour, je suis administrateur de ce site "
                      . "et je peux répondre à vos questions via "
                      . "le formulaire de contact administrateur.")
              ->setAvailability(false)
              ->setDispoBirth(false)
              ->setDispoEmail(false)
              ->setDispoPhone(false)
              ->setDispoAddress(false)
              ->setImage($this->getReference("image1"));
        $manager->persist($user1);
        $this->addReference("user1", $user1);

        $user2 = new User();
        $user2->setFirstName("Karina")
              ->setLastName("PREL")
              ->setUsername("admin")
              ->setPassword("adminpass")
              ->setSalt('')
              ->addRoles('ROLE_ADMIN')
              ->setBirthDate(new \DateTime('12/06/1980'))
              ->setEmail("karina.prel@imie.fr")
              ->setAddress("2 rue des chameaux")
              ->setPostCode("44200")
              ->setCity("Nantes")
              ->setPhone("0658711452")
              ->setDescription("Bonjour, je suis administrateur du site."
                      . " Mon adresse mail est disponnible si vous avez des questions.")
              ->setAvailability(false)
              ->setDispoBirth(false)
              ->setDispoEmail(true)
              ->setDispoPhone(false)
              ->setDispoAddress(false)
              ->setImage($this->getReference("image1"));
        $manager->persist($user2);
        $this->addReference("user2", $user2);

        $user3 = new User();
        $user3->setFirstName("Lena")
              ->setLastName("MILLEPATTES")
              ->setUsername("user3")
              ->setPassword("userpass")
              ->setSalt('')
              ->addRoles('ROLE_USER')
              ->setBirthDate(new \DateTime('02/08/1990'))
              ->setEmail("lena.millepattes@imie.fr")
              ->setAddress("5 rue Jean Jearès")
              ->setPostCode("44400")
              ->setCity("Rezé")
              ->setPhone("0685412512")
              ->setDescription("Ouais, salut, c'est Lena,"
                      . " je ne sais pas faire de développement"
                      . " mais je suis spécialiste en graphisme !")
              ->setAvailability(true)
              ->setDispoBirth(true)
              ->setDispoPhone(true)
              ->setDispoEmail(true)
              ->setDispoAddress(true)
              ->setImage($this->getReference("image2"))
              ->addPromotion($this->getReference("promotion2"))
              ->addPromotion($this->getReference("promotion4"));
        $manager->persist($user3);
        $this->addReference("user3", $user3);

        $user4 = new User();
        $user4->setFirstName("Marie")
              ->setLastName("CHIRAC")
              ->setUsername("user4")
              ->setPassword("userpass")
              ->setSalt('')
              ->addRoles('ROLE_USER')
              ->setBirthDate(new \DateTime('11/09/1983'))
              ->setEmail("marie.chirac@imie.fr")
              ->setAddress("55 boulevard de la Liberté")
              ->setPostCode("44100")
              ->setCity("Nantes")
              ->setPhone("0688474112")
              ->setDescription("Bonjour, je suis passionnée en informatique"
                      . " et je recherche activement des projets PHP.")
              ->setAvailability(true)
              ->setDispoBirth(false)
              ->setDispoPhone(false)
              ->setDispoEmail(true)
              ->setDispoAddress(true)
              ->setImage($this->getReference("image3"))
              ->addPromotion($this->getReference("promotion1"));
        $manager->persist($user4);
        $this->addReference("user4", $user4);

        $user5 = new User();
        $user5->setFirstName("Julien")
              ->setLastName("STRAPONTIN")
              ->setUsername("user5")
              ->setPassword("userpass")
              ->setSalt('')
              ->addRoles('ROLE_USER')
              ->setBirthDate(new \DateTime('03/02/1998'))
              ->setEmail("julien.strapontin@imie.fr")
              ->setAddress("47 rue des petites canailles")
              ->setPostCode("44800")
              ->setCity("Saint-Herblain")
              ->setPhone("0687414522")
              ->setDescription("Je suis avant tout développeur front"
                      . " et je suis disponible pour des projets Javascript")
              ->setAvailability(true)
              ->setDispoBirth(false)
              ->setDispoPhone(false)
              ->setDispoEmail(true)
              ->setDispoAddress(false)
              ->setImage($this->getReference("image4"))
              ->addPromotion($this->getReference("promotion3"));
        $manager->persist($user5);
        $this->addReference("user5", $user5);

        $user6 = new User();
        $user6->setFirstName("Nicolas")
              ->setLastName("L'AGILE")
              ->setUsername("user6")
              ->setPassword("userpass")
              ->setSalt('')
              ->addRoles('ROLE_USER')
              ->setBirthDate(new \DateTime('10/02/1993'))
              ->setEmail("basile.lagile@imie.fr")
              ->setAddress("125 rue des paquerettes")
              ->setPostCode("44100")
              ->setCity("Nantes")
              ->setPhone("0687956321")
              ->setDescription("Je sais faire plein de trucs mais franchement"
                      . " en ce moment j'ai pas envie de bosser.")
              ->setAvailability(false)
              ->setDispoBirth(true)
              ->setDispoPhone(false)
              ->setDispoEmail(true)
              ->setDispoAddress(false)
              ->setImage($this->getReference("image5"))
              ->addPromotion($this->getReference("promotion1"));
        $manager->persist($user6);
        $this->addReference("user6", $user6);

        $manager->flush();      
    }

    public function getOrder() {
        return 4;
    }
}
