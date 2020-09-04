<?php

namespace App\Repository;

use App\Entity\ProjectAssignments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProjectAssignments|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectAssignments|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectAssignments[]    findAll()
 * @method ProjectAssignments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectAssignmentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectAssignments::class);
    }

    // /**
    //  * @return ProjectAssignments[] Returns an array of ProjectAssignments objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProjectAssignments
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
