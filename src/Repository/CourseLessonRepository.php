<?php

namespace App\Repository;

use App\Entity\CourseLesson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Репозиторий уроков.
 *
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

    /**
     * Возвращает активные уроки курса по его коду. И сортирует уроки по дате выхода и индексу сортировки.
     *
     * @param string $courseSlug
     *
     * @return CourseLesson[]
     */
    public function getActiveLessonsByCourseSlug(string $courseSlug): array
    {
        return $this->createQueryBuilder('courseLesson')
            ->andWhere('courseLesson.active = true')
            ->orderBy('courseLesson.date', 'ASC')
            ->orderBy('courseLesson.sort', 'ASC')
            ->join('courseLesson.course', 'course')
            ->andWhere('course.slug = :slug')
            ->setParameter('slug', $courseSlug)
            ->setMaxResults(30)
            ->getQuery()
            ->getResult();
    }

    /**
     * Возвращает все активные уроки с сортировкой по дате и индексу сортировки.
     *
     * @return CourseLesson[]
     */
    public function getAllActiveLessons(): array
    {
        return $this->createQueryBuilder('courseLesson')
            ->andWhere('courseLesson.active = true')
            ->orderBy('courseLesson.date', 'ASC')
            ->orderBy('courseLesson.sort', 'ASC')
            ->setMaxResults(30)
            ->getQuery()
            ->getResult();
    }

    /**
     * Возвращает урок по slug'у.
     *
     * @param string $lessonSlug
     * @param string $courseSlug
     *
     * @return CourseLesson|null
     */
    public function getActiveLessonBySlugs(string $lessonSlug, string $courseSlug): ?CourseLesson
    {
        return $this->createQueryBuilder('lesson')
            ->where('lesson.active = true')
            ->andWhere('lesson.slug = :lessonSlug')
            ->setParameter('lessonSlug', $lessonSlug)
            ->join('lesson.course', 'course')
            ->andWhere('course.slug = :courseSlug')
            ->setParameter('courseSlug', $courseSlug)
            ->getQuery()
            ->getOneOrNullResult();
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
