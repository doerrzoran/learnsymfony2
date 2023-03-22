<?php

namespace App\Controller;

use App\Entity\Test;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    #[Route('/test/add', name: 'Test.add')]
    public function addTest(): Response
    {
        
        $test = new Test();
        $test->setTest('Test');


        // $entityManager->persist($test);
        // $entityManager->flush();

        return $this->render('Test/index.html.twig');
    }
}
