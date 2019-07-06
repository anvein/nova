<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Контроллер для обычных страниц.
 */
class PagesController extends AbstractController
{
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
}
