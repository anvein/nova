<?php

namespace App\Repository;

use App\Entity\Course;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Репозиторий курсов.
 *
 * @method Course|null find($id, $lockMode = null, $lockVersion = null)
 * @method Course|null findOneBy(array $criteria, array $orderBy = null)
 * @method Course[]    findAll()
 * @method Course[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Course::class);
    }

    /**
     * Возвращает активные курсы согласно сортировке (без курса, который реализует раздел "Все курсы").
     *
     * @return Course[]
     */
    public function getActiveExcludeRealizeAllLessonsSection(): array
    {
        return $this->createQueryBuilder('course')
            ->where('course.active = true')
            ->andWhere('course.realizeAllLessonsSection = false')
            ->orderBy('course.sort', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    /**
     * Возвращает активный курс по его коду, либо null.
     *
     * @param string $slug
     *
     * @return Course|null
     */
    public function getActiveCourseBySlug(string $slug): ?Course
    {
        return $this->createQueryBuilder('course')
            ->andWhere('course.active = true')
            ->andWhere('course.slug = :slug')
            ->setParameter('slug', $slug)
            ->orderBy('course.sort', 'ASC')
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Возвращает массив курсов, которые реализуют раздел раздел "Все уроки".
     *
     * @return Course[]
     */
    public function getCoursesRealizedAllLessonsSection(): array
    {
        return $this->createQueryBuilder('c')
            ->where('c.realizeAllLessonsSection = true')
            ->getQuery()
            ->getArrayResult();
    }

    // /**
    //  * @return Course[] Returns an array of Course objects
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
    public function findOneBySomeField($value): ?Course
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
