<?php

namespace App\Repository;

use App\Entity\CourseLesson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CourseLesson|null find($id, $lockMode = null, $lockVersion = null)
 * @method CourseLesson|null findOneBy(array $criteria, array $orderBy = null)
 * @method CourseLesson[]    findAll()
 * @method CourseLesson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourseLessonRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CourseLesson::class);
    }

    // /**
    //  * @return CourseLesson[] Returns an array of CourseLesson objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CourseLesson
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
