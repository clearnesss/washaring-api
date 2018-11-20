<?php

namespace App\Repository;

use App\Entity\ReservationsServices;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ReservationsServices|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationsServices|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationsServices[]    findAll()
 * @method ReservationsServices[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationsServicesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ReservationsServices::class);
    }

    // /**
    //  * @return ReservationsServices[] Returns an array of ReservationsServices objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReservationsServices
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
