<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ProjectRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjectRepository extends EntityRepository
{
    
   //Récupérer tous les projet avec le status et compétences triés par date
    public function findAllPojectsEager() {
        return $this->createQueryBuilder('p')
                    ->addSelect('st')
                    ->addSelect('ps')
                    ->addSelect('sk')
                    ->LeftJoin('p.status', 'st')
                    ->LeftJoin('p.projectSkills', 'ps')
                    ->LeftJoin('ps.skill', 'sk')
                    ->orderBy('p.creationDate', 'DESC')
                    ->getQuery()
                    ->getResult();
    }
    
    //Récupérer un projet avec son status, ses étape...
    //son manager, ses membres et ses compétences recherchées
    public function findOneProjectEager($id) {
        return $this->createQueryBuilder('p')
                    ->addSelect('st')
                    ->addSelect('step')
                    ->addSelect('ststep')
                    ->addSelect('pm')
                    ->addSelect('m')
                    ->addSelect('u')
                    ->addSelect('ps')
                    ->addSelect('sk')
                    ->LeftJoin('p.status', 'st')
                    ->LeftJoin('p.steps', 'step')
                    ->LeftJoin('step.status', 'ststep')
                    ->LeftJoin('p.projectManager', 'pm')
                    ->LeftJoin('p.projectMembers', 'm')
                    ->LeftJoin('m.user', 'u')
                    ->LeftJoin('p.projectSkills', 'ps')
                    ->LeftJoin('ps.skill', 'sk')
                    ->where('p.id = :id')
                    ->setParameter('id', $id)
                    ->getQuery()
                    ->getOneOrNullResult();
    }
}
