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

    #[Route('/', name: 'app_admin_dashboard', methods: ['GET'])]
    public function dashboard() : Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    #[Route('/user/create', name: 'app_admin_user_create', methods: ['GET', 'POST'])]
    public function createUser(
        Request $request,
    ) : Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('plainPassword')->getData();
            $confirmPassword = $form->get('confirmPassword')->getData();

            if ($plainPassword !== $confirmPassword) {
                $form->addError(new FormError('Les mots de passe ne correspondent pas.'));
            } else {
                $this->userManager->createUserFromAdmin($user, $plainPassword);

                return $this->redirectToRoute('app_admin_dashboard', [], Response::HTTP_CREATED);
            }
        }

        return $this->render('admin/user/create.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}