<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        
        $category1 = new Category();
        $category1->getName('Web');
        $manager->persist($category1);
        
        $category2 = new Category();
        $category2->getName('Reseau');
        $manager->persist($category2);
        
        $category3 = new Category();
        $category3->gettName('Graphiste');
        $manager->persist($category3);
        
        $manager->flush();
        
        $this->addReference('Web', $category1);
        $this->addReference('Reseau', $category2);
        $this->addReference('Graphiste', $category3);
    }
    public function getOrder() {
        return 5;
    }
}