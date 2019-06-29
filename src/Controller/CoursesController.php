<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CourseLessonRepository;
use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

// todo - проработать пагинацию

/**
 * Контроллер для раздела "Курсы".
 */
class CoursesController extends AbstractController
{


    /**
     * @var CourseRepository $courseRepository
     */
    protected $courseRepository;

    /**
     * @var CourseLessonRepository $courseLessonRepository
     */
    protected $courseLessonRepository;

    public function __construct(CourseRepository $courseRepository, CourseLessonRepository $courseLessonRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->courseLessonRepository = $courseLessonRepository;
    }

    /**
     * Список курсов.
     *
     * @Route("/courses", name="courses_list")
     */
    public function coursesList(): Response
    {
        $courses = $this->courseRepository->getActive();

        $response = $this->render('courses/coursesList.html.twig', [
            'courses' => $courses
        ]);

        return $response;
    }

    /**
     * Список уроков курса.
     *
     * @Route("/courses/{courseSlug}/{page}", name="courses_course", requirements={"page"="\d+"})
     */
    public function courseLessonsList(string $courseSlug, int $page = 1): Response
    {
        $lessons = [];
        $title = '';

        if ($courseSlug === 'all-lessons') {
            $title = 'Все уроки';
            $lessons = $this->courseLessonRepository->getAllActiveLessons();
        } elseif ($course = $this->courseRepository->getActiveCourseBySlug($courseSlug)) {
            $title = "{$course->getType()}: {$course->getTitle()}";
            $lessons = $this->courseLessonRepository->getActiveLessonsByCourseSlug($courseSlug);
        } else {
            throw new NotFoundHttpException('Курс не найден 😞');
        }

        $response = $this->render('courses/courseVideosList.html.twig', [
            'lessons' => $lessons,
            'title' => $title,
        ]);

        return $response;
    }

    /**
     * Детальная страница урока.
     *
     * @Route("/courses/{courseSlug}/{lessonSlug}", name="courses_lesson_detail")
     */
    public function lessonDetail(string $courseSlug, string $lessonSlug): Response
    {
        // p.s.: фильтрация по slug'у курса не сделана умышленно

        $lesson = $this->courseLessonRepository->getActiveLessonBySlug($lessonSlug);
        if (is_null($lesson)) {
            throw new NotFoundHttpException('Урок не найден 😥');
        }

        $response = $this->render('courses/courseLessonDetail.html.twig', [
            'lesson' => $lesson,
        ]);

        return $response;
    }
}
