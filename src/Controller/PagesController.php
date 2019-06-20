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
     * @Route("/", name="page_home")
     */
    public function home(): Response
    {
        return $this->render('pages/home.html.twig');
    }
}
