<?php

namespace App\Repository;

use App\Entity\PaymentStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PaymentStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaymentStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaymentStatus[]    findAll()
 * @method PaymentStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymentStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaymentStatus::class);
    }

    // /**
    //  * @return PaymentStatus[] Returns an array of PaymentStatus objects
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
    public function findOneBySomeField($value): ?PaymentStatus
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
