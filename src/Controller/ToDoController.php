<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/todo")]
class ToDoController extends AbstractController
{
    #[Route('/to/do', name: 'to_do')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();  
        //afficher notre tableau de todo
        //sinon je l'initialise puis je l'affiche 
        if(!$session->has('todo')){
           $todo = [
            'achat' => 'acheter clé usb',
            'cours' => 'Finaliser mon cours',
            'correction' => 'corriger mes examens'
           ];
           $session->set('todo', $todo);
           $this->addFlash('info', 'la liste des todo viens d\'etre initialisée');
        }
        //si j'ai mon tableau todo dans ma session je ne fais que l'afficher  
        return $this->render('to_do/index.html.twig');
    }
    #[Route('/to/do/add/{name?test}/{content?test} ', name: 'to_do.add')]
    public function addToDo(Request $request, $name, $content) {
        $session = $request->getSession();
        // Verifier si j'ai mon tableau todo dans la session
        if($session->has('todo')){
            // si oui 
            // Verifier si on a deja un todo avec le meme name
            $todo = $session->get('todo');
            if(isset($todo[$name])){
                // si oui afficher erreur
                $this->addFlash('error', 'le todo '.$name.' existe déja');
            }else{
                // si non on l'ajoute et on l'affiche un message de succès
                $todo[$name] = $content;
                $this->addFlash('success', 'le todo '.$name.' à été ajouté avec succès');
                $session->set('todo', $todo);
            }
                
                
        }else{
            // si non
                // afficher une erreur et rediriger vers le controller initial 
            $this->addFlash('error', 'la liste des todo n\'est pas encore initialisée initialisée');
        }
        return $this->redirectToRoute('to_do');
    }

    #[Route('/multi/{entier1}<\d+>/{entier2<\d+>}')]
    public function multiplication($entier1, $entier2){
        $resultat = $entier1 * $entier2;
        return new Response($resultat);
    }    
}
