<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Comment;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCommentData extends AbstractFixture implements OrderedFixtureInterface {
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
       
        $comment1 = new Comment();
        $comment1->setAuthor($this->getReference('user6'))
                        ->setContent('Je viens de finir ma partie en html...'
                                . ' Je pense que l\'on peut maintenant partir sur le reste')
                        ->setProject($this->getReference('project3'));
        $manager->persist($comment1);
        
        $comment2 = new Comment();
        $comment2->setAuthor($this->getReference('user5'))
                        ->setContent('Je vais commencer à développer la partie'
                                . ' en Javascript sur la page d\'accueil.')
                        ->setProject($this->getReference('project3'));
        $manager->persist($comment2);
        
        $comment3 = new Comment();
        $comment3->setAuthor($this->getReference('user5'))
                        ->setContent('Je vais cloturer le site :) Merci Nicolas pour ton travail.')
                        ->setProject($this->getReference('project3'));
        $manager->persist($comment3);
        
        $comment4 = new Comment();
        $comment4->setAuthor($this->getReference('user4'))
                        ->setContent('Bon, je viens de passer le projet en status en cours.'
                                . ' Nous sommes donc officiellement en action !')
                        ->setProject($this->getReference('project2'));
        $manager->persist($comment4);
        
        $comment5 = new Comment();
        $comment5->setAuthor($this->getReference('user3'))
                        ->setContent('Je commence le maquettage sous photoshop dès demain matin.')
                        ->setProject($this->getReference('project2'));
        $manager->persist($comment5);
        
        $comment6 = new Comment();
        $comment6->setAuthor($this->getReference('user5'))
                        ->setContent('Cool, j\'ai hâte de pouvoir me mettre au travail.')
                        ->setProject($this->getReference('project2'));
        $manager->persist($comment6);
        
        $manager->flush();
    }
    
    public function getOrder() {
        return 15;
    }
    
}
