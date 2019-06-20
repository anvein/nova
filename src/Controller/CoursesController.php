<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Контроллер для раздела "Курсы".
 */
class CoursesController extends AbstractController
{
    /**
     * @Route("/courses", name="courses_list")
     */
    public function coursesList()
    {
        $response = $this->render('courses/coursesList.html.twig', []);

        return $response;
    }


    /**
     * @Route("/courses/course", name="courses_course")
     */
    public function courseLessonsList()
    {

        $response = $this->render('courses/courseVideosList.html.twig', []);

        return $response;
    }

    /**
     * @Route("/courses/course/lesson", name="courses_lesson_detail")
     */
    public function lessonDetail()
    {
        $response = $this->render('courses/courseLessonDetail.html.twig', []);

        return $response;
    }

}