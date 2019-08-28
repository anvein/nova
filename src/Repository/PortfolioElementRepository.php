<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\PortfolioElement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Репозиторий элементов портфолио.
 *
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

}
