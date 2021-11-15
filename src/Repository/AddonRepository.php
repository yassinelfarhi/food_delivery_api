<?php

namespace App\Repository;

use App\Entity\Addon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Addon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Addon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Addon[]    findAll()
 * @method Addon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Addon::class);
    }

    // /**
    //  * @return Addon[] Returns an array of Addon objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Addon
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
