<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\PortfolioCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Репозиторий "категории портфолио".
 *
 * @method PortfolioCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method PortfolioCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method PortfolioCategory[]    findAll()
 * @method PortfolioCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PortfolioCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PortfolioCategory::class);
    }

}
