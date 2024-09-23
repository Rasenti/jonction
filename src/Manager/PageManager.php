<?php

namespace App\Manager;

use App\Entity\Page;
use App\Repository\PageRepository;
use Doctrine\ORM\EntityManagerInterface;

readonly class PageManager
{
    public function __construct(
        private EntityManagerInterface $em,
        private PageRepository $pageRepository,
    ){
    }

    public function findAll(): array
    {
        return $this->pageRepository->findAll();
    }

    public function createPageFromAdmin(Page $page): void
    {
        $this->em->persist($page);
        $this->em->flush();
    }

    public function updatePageFromAdmin(Page $page): void
    {
        $this->em->persist($page);
        $this->em->flush();
    }

    public function deletePage(Page $page): void
    {
        $this->em->remove($page);
        $this->em->flush();
    }
}