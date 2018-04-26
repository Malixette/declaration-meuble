<?php

namespace App\Repository;

use App\Entity\OfficeTourisme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OfficeTourisme|null find($id, $lockMode = null, $lockVersion = null)
 * @method OfficeTourisme|null findOneBy(array $criteria, array $orderBy = null)
 * @method OfficeTourisme[]    findAll()
 * @method OfficeTourisme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfficeTourismeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OfficeTourisme::class);
    }

//    /**
//     * @return OfficeTourisme[] Returns an array of OfficeTourisme objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OfficeTourisme
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
