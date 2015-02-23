<?php

namespace AppBundle\DataFixtures\ORM;

use BlogBundle\Entity\Project;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadProjectData extends AbstractFixture implements OrderedFixtureInterface {
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
       
        $project1 = new Project();

        $manager->persist($project1);
        
        $manager->flush(); 
        
        $this->addReference('project1', $project1);

    }
    
    public function getOrder() {
        return 8;
    }
    
}
