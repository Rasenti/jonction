<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CompendiumController extends AbstractController
{
    #[Route('/compendium', name: 'app_compendium')]
    public function index() : Response
    {
        return $this->render('compendium/compendium.html.twig');
    }
}