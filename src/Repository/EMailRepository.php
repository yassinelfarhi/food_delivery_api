<?php

namespace App\Repository;

use App\Entity\EMail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EMail|null find($id, $lockMode = null, $lockVersion = null)
 * @method EMail|null findOneBy(array $criteria, array $orderBy = null)
 * @method EMail[]    findAll()
 * @method EMail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EMailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EMail::class);
    }

    // /**
    //  * @return EMail[] Returns an array of EMail objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EMail
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
