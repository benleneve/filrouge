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
        $category1->setName('Langage');
        $manager->persist($category1);
        $this->addReference('category1', $category1);
        
        $category2 = new Category();
        $category2->setName('Framework');
        $manager->persist($category2);
        $this->addReference('category2', $category2);
        
        $category3 = new Category();
        $category3->setName('Graphisme');
        $manager->persist($category3);
        $this->addReference('category3', $category3);
        
        $manager->flush();
    }
    
    public function getOrder() {
        return 5;
    }
}