<?php

namespace App\Repository;

use App\Entity\Orders;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Orders|null find($id, $lockMode = null, $lockVersion = null)
 * @method Orders|null findOneBy(array $criteria, array $orderBy = null)
 * @method Orders[]    findAll()
 * @method Orders[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Orders::class);
    }
    public function findByCart($value)
    {
        return $this->createQueryBuilder('o')
            ->setParameter('cart', $value)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Orders[] Returns an array of Orders objects
    //  */


    public function findAllStatus($value)
    {
        return $this->createQueryBuilder('o')
            ->setParameter('status', $value)
            ->getQuery()
            
        ;
    }
    
}
