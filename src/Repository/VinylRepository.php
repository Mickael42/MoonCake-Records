<?php

namespace App\Repository;

use App\Entity\Vinyl;
use Doctrine\ORM\Query;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Vinyl|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vinyl|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vinyl[]    findAll()
 * @method Vinyl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VinylRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vinyl::class);
    }

    // /**
    //  * @return Query
    //  */

    public function findAllQuery(): Query
    {
        return $this->createQueryBuilder('u')
            ->orderBy('u.id', 'DESC')
            ->getQuery();
    }


    public function finByGenreQuery($value): Query
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.genre = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'DESC')
            ->getQuery();
    }



    public function findAllVinylPromoQuery(): Query
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.reducePrice > 0')
            ->orderBy('v.id', 'ASC')
            ->getQuery();
    }
    // /**
    //  * @return Vinyl[] Returns an array of Vinyl objects
    //  */
    public function findByLastVinyls($value)
    {
        return $this->createQueryBuilder('u')
            ->orderBy('u.id', 'DESC')
            ->setMaxResults($value)
            ->getQuery()
            ->getResult();
    }

    public function findByRelatedVinyls($value)
    {
        return $this->createQueryBuilder('u')
            ->orderBy('u.id', 'DESC')
            ->andWhere('u.genre = :val')
            ->setParameter('val', $value)
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Vinyl
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
