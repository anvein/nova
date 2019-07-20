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
     * @var CourseRepository
     */
    protected $courseRepository;

    /**
     * @var CourseLessonRepository
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
     * @Route("/courses", name="courses_list", methods={"GET"})
     */
    public function coursesList(): Response
    {
        $courses = $this->courseRepository->getActiveExcludeRealizeAllLessonsSection();

        $response = $this->render('courses/coursesList.html.twig', [
            'courses' => $courses,
        ]);

        return $response;
    }

    /**
     * Список уроков курса.
     *
     * @Route("/courses/{courseSlug}/{page}", name="courses_course", requirements={"page"="\d+"}, methods={"GET"})
     */
    public function courseLessonsList(string $courseSlug, int $page = 1): Response
    {
        $course = $this->courseRepository->getActiveCourseBySlug($courseSlug);

        if (is_null($course)) {
            throw new NotFoundHttpException('Курс не найден');
        } elseif ($course->getRealizeAllLessonsSection()) {
            $lessons = $this->courseLessonRepository->getAllActiveLessons();
        } else {
            $lessons = $this->courseLessonRepository->getActiveLessonsByCourseSlug($courseSlug);
        }

        $response = $this->render('courses/courseVideosList.html.twig', [
            'course' => $course,
            'lessons' => $lessons,
        ]);

        return $response;
    }

    /**
     * Детальная страница урока.
     *
     * @Route("/courses/{courseSlug}/{lessonSlug}", name="courses_lesson_detail", methods={"GET"})
     */
    public function lessonDetail(string $courseSlug, string $lessonSlug): Response
    {
        $lesson = $this->courseLessonRepository->getActiveLessonBySlugs($lessonSlug, $courseSlug);
        if (is_null($lesson)) {
            throw new NotFoundHttpException('Урок не найден');
        }

        $response = $this->render('courses/courseLessonDetail.html.twig', [
            'lesson' => $lesson,
        ]);

        return $response;
    }
}
