<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use App\Manager\UserManager;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/users')]
class UserController extends AbstractController
{
    public function __construct(
        private readonly UserManager $userManager,
    ){}

    #[Route('/', name: 'admin_user_list', methods: ['GET'])]
    public function list() : Response
    {
        return $this->render('admin/user/list.html.twig', [
            'users' => $this->userManager->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'admin_user_show', methods: ['GET'])]
    public function show(User $user) : Response
    {
        return $this->render('admin/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/new', name: 'admin_user_create', methods: ['GET', 'POST'])]
    public function create(
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

    #[Route('/{id}/edit', name: 'admin_user_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        User $user,
    ): Response {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('plainPassword')->getData();
            $confirmPassword = $form->get('confirmPassword')->getData();

            if ($plainPassword !== $confirmPassword) {
                $form->addError(new FormError('Les mots de passe ne correspondent pas.'));
            } else {
                $this->userManager->updateUserFromAdmin($user, $plainPassword);

                return $this->redirectToRoute('admin_user_list', [], Response::HTTP_ACCEPTED);
            }
        }

        return $this->render('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/delete', name: 'admin_user_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        User $user
    ): Response {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $this->userManager->deleteUser($user);
        }

        return $this->redirectToRoute('admin_user_list', [], Response::HTTP_ACCEPTED);
    }
}