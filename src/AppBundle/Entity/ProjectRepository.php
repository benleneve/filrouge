<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * ProjectRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjectRepository extends EntityRepository
{
 
    //Récupérer tous les projet avec le status et compétences
    //triés par date et pagination
    public function findAllProjectsPageEager($page= 1, $maxPerPage = 5) {
        $query = $this->createQueryBuilder('p')
                    ->addSelect('st')
                    ->addSelect('ps')
                    ->addSelect('sk')
                    ->LeftJoin('p.status', 'st')
                    ->LeftJoin('p.projectSkills', 'ps')
                    ->LeftJoin('ps.skill', 'sk')
                    ->orderBy('p.creationDate', 'DESC');
        $query->setFirstResult(($page-1)*$maxPerPage)
              ->setMaxResults($maxPerPage);
        return new Paginator($query);        
    }
    
    //Fonction du moteur de recherche
    public function findSearchProjectsPageEager($name, $status, $skill1, $skill2, $skill3, $recrut) {
        $query = $this->createQueryBuilder('p')
                    ->addSelect('st')
                    ->addSelect('ps')
                    ->addSelect('sk')
                    ->LeftJoin('p.status', 'st')
                    ->LeftJoin('p.projectSkills', 'ps')
                    ->LeftJoin('ps.skill', 'sk');
        if($name != 'none') {
            $query->andWhere('p.name LIKE :name')
                  ->setParameter('name', '%' . $name . '%');
        }
        if($status != 'none') {
            $query->andWhere('st.id = :status')
                  ->setParameter('status', $status);
        }
        if($skill1 != 'none') {
            $query->orWhere('sk.name = :skill1')
                  ->setParameter('skill1', $skill1);
        }
        if($skill2 != 'none') {
            $query->orWhere('sk.name = :skill2')
                  ->setParameter('skill2', $skill2);
        }
        if($skill2 != 'none') {
            $query->orWhere('sk.name = :skill3')
                  ->setParameter('skill3', $skill3);
        }
        if($recrut) {
            $query->andWhere('ps.active = :recrut')
                  ->setParameter('recrut', $recrut);
        }
        $query->orderBy('p.creationDate', 'DESC');
        return $query->getQuery()->getResult();
    }
 
    //Récupérer tous les projet d'un utilisateur
    //triés par date et pagination
    public function findAllProjectsByUserPageEager($page= 1, $maxPerPage = 5, $id) {
        $query = $this->createQueryBuilder('p')
                    ->addSelect('st')
                    ->addSelect('ps')
                    ->addSelect('sk')
                    ->addSelect('u')
                    ->addSelect('up')
                    ->addSelect('upu')
                    ->LeftJoin('p.status', 'st')
                    ->LeftJoin('p.projectSkills', 'ps')
                    ->LeftJoin('ps.skill', 'sk')
                    ->LeftJoin('p.projectManager', 'u')
                    ->LeftJoin('p.projectMembers', 'up')
                    ->leftJoin('up.user', 'upu')
                    ->where('u.id = :id')
                    ->orWhere('upu.id = :id')
                    ->setParameter('id', $id)
                    ->orderBy('p.creationDate', 'DESC');
        $query->setFirstResult(($page-1)*$maxPerPage)
              ->setMaxResults($maxPerPage);
        return new Paginator($query);        
    }
    
    //Récupérer tous les projet avec le status et compétences
    //triés par date
    public function findAllProjectsEager() {
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
    
    //Récupérer tous les projet d'un utilisateur
    //triés par date
    public function findAllProjectsByUserEager($id) {
        return $this->createQueryBuilder('p')
                    ->addSelect('st')
                    ->addSelect('ps')
                    ->addSelect('sk')
                    ->addSelect('u')
                    ->addSelect('up')
                    ->addSelect('upu')
                    ->LeftJoin('p.status', 'st')
                    ->LeftJoin('p.projectSkills', 'ps')
                    ->LeftJoin('ps.skill', 'sk')
                    ->LeftJoin('p.projectManager', 'u')
                    ->LeftJoin('p.projectMembers', 'up')
                    ->leftJoin('up.user', 'upu')
                    ->where('u.id = :id')
                    ->orWhere('upu.id = :id')
                    ->setParameter('id', $id)
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
