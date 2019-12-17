<?php


namespace App\Repository;

use App\Entity\Activity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * Class ActivityRepository
 * @package App\Repository
 */
class ActivityRepository extends ServiceEntityRepository
{

    /**
     * ActivityRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activity::class);
    }

    /**
     * @param string $name
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function findByCategory(string $name, $limit = null, $offset = null) {
        return $this->getEntityManager()
            ->getRepository(Activity::class)
            ->createQueryBuilder('a')
            ->innerJoin('a.categories', 'c')
            ->where('c.name = :categoryName')
            ->setParameter('categoryName', $name)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()->getResult();
    }

    /**
     * @param int $price
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function findByMaxPrice(int $price, $limit = null, $offset = null) {
        return $this->getEntityManager()
            ->getRepository(Activity::class)
            ->createQueryBuilder('a')
            ->select('a')
            ->where('a.price <= :price')
            ->setParameter('price', $price)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()->getResult();
    }
}