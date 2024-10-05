<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use App\Form\PageType;
use App\Manager\PageManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/categories')]
class CategoryController extends AbstractController
{
    public function __construct(
        private readonly PageManager $categoryManager,
    ){}

    #[Route('/', name: 'admin_category_list', methods: ['GET'])]
    public function list() : Response
    {
        return $this->render('admin/category/list.html.twig', [
            'categories' => $this->categoryManager->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'admin_category_show', methods: ['GET'])]
    public function show(Page $category) : Response
    {
        return $this->render('admin/category/show.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/new', name: 'admin_category_create', methods: ['GET', 'POST'])]
    public function create(
        Request $request,
    ) : Response
    {
        $category = new page();
        $form = $this->createForm(PageType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->categoryManager->createPageFromAdmin($category);

            return $this->redirectToRoute('admin_category_list', [], Response::HTTP_CREATED);
        }

        return $this->render('admin/category/create.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_category_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Page $category,
    ): Response {
        $form = $this->createForm(PageType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->categoryManager->createPageFromAdmin($category);

            return $this->redirectToRoute('admin_category_list', [], Response::HTTP_CREATED);
        }

        return $this->render('admin/category/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/delete', name: 'admin_category_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        Page $category
    ): Response {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $this->categoryManager->deletePage($category);
        }

        return $this->redirectToRoute('admin_category_list', [], Response::HTTP_ACCEPTED);
    }
}