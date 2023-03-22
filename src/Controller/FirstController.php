<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/order/{maVar}', name: 'test.order.route')]
    public function testOrderRoute($maVar){
        return new Response($maVar);
    } 

    #[Route('/template', name: 'template')]
    public function template(){
        return $this->render('template.html.twig');
    } 

    #[Route('/', name: 'first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'firstname' => 'Zoran',
            'name' => 'Doerr', 
            'path' => '  ', 
        ]);
    }

    #[Route('/rand', name: 'rand')]
    public function test(): Response
    {
        return $this->forward('App\\Controller\\FirstController::index');
    }
    
    #[Route('/hello/{name}/{firstname}', name: 'hello')]
    public function hello(Request $request, $name, $firstname): Response
    {
        // dd($request);
        return $this->render('first/hello.html.twig', ['name' => $name, 'firstname' => $firstname]);
    }
}


return('hello');
