<?php

namespace App\Repository;

use App\Entity\ActivityCategoryLink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ActivityCategoryLink|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActivityCategoryLink|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActivityCategoryLink[]    findAll()
 * @method ActivityCategoryLink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivityCategoryLinkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActivityCategoryLink::class);
    }

    // /**
    //  * @return ActivityCategoryLink[] Returns an array of ActivityCategoryLink objects
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
    public function findOneBySomeField($value): ?ActivityCategoryLink
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
