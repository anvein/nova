<?php

namespace App\Repository;

use App\Entity\PortfolioElement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PortfolioElement|null find($id, $lockMode = null, $lockVersion = null)
 * @method PortfolioElement|null findOneBy(array $criteria, array $orderBy = null)
 * @method PortfolioElement[]    findAll()
 * @method PortfolioElement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PortfolioElementRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PortfolioElement::class);
    }

    // /**
    //  * @return PortfolioElement[] Returns an array of PortfolioElement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PortfolioElement
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
