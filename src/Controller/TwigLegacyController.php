<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TwigLegacyController extends AbstractController
{
    #[Route('/twig/legacy', name: 'app_twig_legacy')]
    public function index(): Response
    {
        return $this->render('twig_legacy\index.html.twig');
    }
}
