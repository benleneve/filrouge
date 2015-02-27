<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
    {
        public function findOneUserEager($id)
            {
                $query = $this->createQueryBuilder('u')
                        ->leftJoin('u.image', 'i')
                        ->addSelect('i')
                        ->leftJoin('u.promotions', 'p')
                        ->addSelect('p')
                        ->leftJoin('u.worksOnProjects', 'wp')
                        ->addSelect('wp')
                        ->leftJoin('wp.project', 'pr')
                        ->addSelect('pr')
                        ->leftJoin('u.userSkills', 'us')
                        ->addSelect('us')
                        ->leftJoin('us.skill', 's')
                        ->addSelect('s')
                        ->where('u.id = :id')
                        ->setParameter('id', $id);

                return $query->getQuery()->getOneOrNullResult();
            }
    
        public function findAllUsersEager($page= 1, $maxPerPage = 5)
            {
                $query = $this->createQueryBuilder('u')
                        ->leftjoin('u.promotions', 'p')
                        ->addSelect('p')
                        ->orderBy('u.lastName');
                $query->setFirstResult(($page-1)*$maxPerPage)
                      ->setMaxResults($maxPerPage);
                        
                return new Paginator($query);

            }
            
               
    }
