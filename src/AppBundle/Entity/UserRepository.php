<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

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
                        ->join('u.promotions', 'p')
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
    
        public function findAllUsersEager()
            {
                $query = $this->createQueryBuilder('u')
                        ->leftjoin('u.promotions', 'p')
                        ->addSelect('p')
                        ->orderBy('u.lastName');

                return $query->getQuery()->getResult();

            }
    }
