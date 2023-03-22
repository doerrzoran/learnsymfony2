<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TabController extends AbstractController
{
    #[Route('/tab/users', name: 'tab_users')]
    public function users(): Response
    {
        $users = [
            ['firstname' => 'zoran', 'name' => 'doerr', 'age'=> '28'],
            ['firstname' => 'john', 'name' => 'doe', 'age'=> '13'],
            ['firstname' => 'abdel', 'name' => 'woush', 'age'=> '46']
        ];
        return $this->render('tab/users.html.twig', [
            'users' => $users
        ]);  
    }

    #[Route('/tab/{nb?5<\d+>}', name: 'tab')]
    public function index($nb): Response
    {
        $notes = [];
        for($i =0 ; $i<$nb ; $i++){
            $notes[]= rand(0, $nb);
        }
        return $this->render('tab/index.html.twig', [
            'notes' => $notes,
        ]);
    }
};

