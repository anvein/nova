<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Exception;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Контроллер для реализации выхода из системы.
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/admin/logout", name="app_logout", methods={"GET"})
     */
    public function logout(): void
    {
        throw new Exception('Если этот код выполнился, значит в компоненте security не сконфигурирован параметр logout');
    }

    /**
     * @Route("/admin/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
}