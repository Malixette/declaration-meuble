<?php

namespace App\Repository;

use App\Entity\InfosComplementaires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InfosComplementaires|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfosComplementaires|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfosComplementaires[]    findAll()
 * @method InfosComplementaires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfosComplementairesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InfosComplementaires::class);
    }

//    /**
//     * @return InfosComplementaires[] Returns an array of InfosComplementaires objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InfosComplementaires
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
