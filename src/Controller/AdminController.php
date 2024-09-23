<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Manager\UserManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    public function __construct(
        private readonly UserManager $userManager,
    ){}

    #[Route('', name: 'app_admin_dashboard', methods: ['GET'])]
    public function dashboard() : Response
    {
        return $this->render('admin/dashboard.html.twig');
    }
}