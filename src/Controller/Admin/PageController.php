<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use App\Form\PageType;
use App\Manager\PageManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/pages')]
class PageController extends AbstractController
{
    public function __construct(
        private readonly PageManager $pageManager,
    ){}

    #[Route('/', name: 'admin_page_list', methods: ['GET'])]
    public function list() : Response
    {
        return $this->render('admin/page/list.html.twig', [
            'pages' => $this->pageManager->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'admin_page_show', methods: ['GET'])]
    public function show(Page $page) : Response
    {
        return $this->render('admin/page/show.html.twig', [
            'page' => $page,
        ]);
    }

    #[Route('/new', name: 'admin_page_create', methods: ['GET', 'POST'])]
    public function create(
        Request $request,
    ) : Response
    {
        $page = new page();
        $form = $this->createForm(PageType::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->pageManager->createPageFromAdmin($page);

            return $this->redirectToRoute('admin_page_list', [], Response::HTTP_CREATED);
        }

        return $this->render('admin/page/create.html.twig', [
            'page' => $page,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_page_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Page $page,
    ): Response {
        $form = $this->createForm(PageType::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->pageManager->createPageFromAdmin($page);

            return $this->redirectToRoute('admin_page_list', [], Response::HTTP_CREATED);
        }

        return $this->render('admin/page/edit.html.twig', [
            'page' => $page,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/delete', name: 'admin_page_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        Page $page
    ): Response {
        if ($this->isCsrfTokenValid('delete'.$page->getId(), $request->request->get('_token'))) {
            $this->pageManager->deletePage($page);
        }

        return $this->redirectToRoute('admin_page_list', [], Response::HTTP_ACCEPTED);
    }
}