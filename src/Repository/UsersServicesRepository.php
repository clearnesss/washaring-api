<?php

namespace App\Repository;

use App\Entity\UsersServices;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UsersServices|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsersServices|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsersServices[]    findAll()
 * @method UsersServices[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersServicesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UsersServices::class);
    }

    // /**
    //  * @return UsersServices[] Returns an array of UsersServices objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UsersServices
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
