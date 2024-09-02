<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'app_admin_dashboard', methods: ['GET'])]
    public function dashboard() : Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    #[Route('/admin/create', name: 'app_admin_create', methods: ['GET', 'POST'])]
    public function create() : Response
    {
        return $this->render('admin/dashboard.html.twig');
    }
}