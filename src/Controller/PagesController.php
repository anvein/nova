<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Course;
use App\Form\CourseType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Контроллер для обычных страниц.
 */
class PagesController extends AbstractController
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var FormFactoryInterface
     */
    protected $formFactory;

    public function __construct(ObjectManager $objectManager, FormFactoryInterface $formFactory)
    {
        $this->objectManager = $objectManager;
        $this->formFactory = $formFactory;
    }

    /**
     * Главная страница.
     *
     * @Route("/", name="page_home", methods={"GET"})
     */
    public function homePage(): Response
    {
        return $this->redirectToRoute('courses_list');
    }

    /**
     * Страница контакты.
     *
     * @Route("/contacts", name="page_contact", methods={"GET"})
     */
    public function contactPage(): Response
    {
        return $this->render('pages/pageDevelopment.html.twig');
    }

    /**
     * Новый курс.
     *
     * @Route("/course/new", name="new_course")
     *
     * @return Response
     */
    public function newCourse(Request $request): Response
    {
        $course = new Course;

        return $this->handleCourse($request, $course);
    }

    /**
     * Редактирование курса.
     *
     * @Route("/course/{slug}", name="edit_course")
     *
     * @return Response
     */
    public function editCourse(Request $request, string $slug): Response
    {
        $course = $this->getDoctrine()->getRepository(Course::class)->findOneBy(['slug' => $slug]);

        if (is_null($course)) {
            throw new NotFoundHttpException('Курс не найден');
        }

        return $this->handleCourse($request, $course);
    }


    /**
     * Обрабатывает курс.
     *
     * @param Request $request
     * @param Course  $course
     *
     * @return Response
     */
    protected function handleCourse(Request $request, Course $course): Response
    {
        $form = $this->formFactory->create(CourseType::class, $course);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $course= $form->getData();

            $this->objectManager->persist($course);
            $this->objectManager->flush();
        }

        return $this->render('pages/pageTestForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
