<?php

namespace App\Repository;

use App\Entity\TEST;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TEST|null find($id, $lockMode = null, $lockVersion = null)
 * @method TEST|null findOneBy(array $criteria, array $orderBy = null)
 * @method TEST[]    findAll()
 * @method TEST[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TESTRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TEST::class);
    }

    // /**
    //  * @return TEST[] Returns an array of TEST objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TEST
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
