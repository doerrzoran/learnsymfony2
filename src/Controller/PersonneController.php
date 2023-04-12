<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Form\PersonneType;
use App\Repository\PersonneRepository;
use Doctrine\Persistence\ManagerRegistry;
use Faker\Provider\ar_JO\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('personne')]
class PersonneController extends AbstractController
{
    #[Route('/', name: 'personne.list')]
    public function index(ManagerRegistry $doctrine): Response 
    {
        $repository = $doctrine->getRepository(persistentObject:Personne::class);
        $personnes = $repository->findAll();

        return $this->render('personne/index.html.twig', [
            'personnes' => $personnes,
            'isPaginated' => true
        ] );
    }

    #[Route('/alls/{page?1}/{nbre?12}', name: 'personne.list.alls')]
    public function indexAll(ManagerRegistry $doctrine, $page, $nbre): Response 
    {
        $repository = new PersonneRepository($doctrine);
        $nbPersonne = $repository->count([]);
        // $nbrePage = $nbPersonne / $nbre;
        //24
        $nbrePage = ceil($nbPersonne / $nbre);
        // dd($nbrePage);
        $personnes = $repository->findBy([], [], $nbre, ($page -1) * $nbre);

        return $this->render('personne/index.html.twig', [
            'personnes' => $personnes,
            'isPaginated' => true,
            'nbrePage' => $nbrePage,
            'page' => $page,
            'nbre' => $nbre
        ] );
    }

    #[Route('/{id<\d+>}', name: 'personne.detail')]
    public function detail(ManagerRegistry $doctrine, $id): Response 
    {
        $repository = new PersonneRepository($doctrine);
        $personne = $repository->find($id);
        if(!$personne){
            $this->addFlash('error', "La personne d'id $id n'existe pas");
            return $this->redirectToRoute('personne.list');
        }
        return $this->render('personne/detail.html.twig', [
            'personne' => $personne
        ] );
    }

    #[Route('/add', name: 'personne.add')]
    public function addPersonne(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $personne = new Personne();
        $form = $this->createForm(PersonneType::class, $personne);

        return $this->render('personne/add-personne.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/delete/{id<\d+>} ', name: 'personne.delete')]
    public function deletePersonne(Personne $personne = null, ManagerRegistry $doctrine): RedirectResponse{
        // recuperer la personne
        if($personne){
            //si la personne existe => supprimer et retourner un fleshmessage de succes
            $manager = $doctrine->getManager();
            $manager->remove($personne);
            $manager->flush();
            $this->addFlash('success', "La personne a été supprimé avec succès");
            
        }else{
            //sinon retourner un flasmessage d'erreur
            $this->addFlash('error', "Personne innexistante");
        };
        return $this->redirectToRoute('personne.list.alls');
    }

    #[Route('/update/{id}/{name}/{firstname}/{age}', name: 'personne.update')]
    public function updatePersonne(Personne $personne = null, ManagerRegistry $doctrine, $name, $firstname, $age): Response {
        //verifier que la personne existe
        if ($personne) {
            //si oui, mettre à jour la personne = message de succes
            $personne->setName($name);
            $personne->setFirstname($firstname);
            $personne->setAge($age);
            $manager = $doctrine->getManager();
            $manager->persist($personne);
            $manager->flush();
           $this->addFlash('success', "La personne a été mise à jour"); 
        }else{
            // sinon message d'erreur
            $this->addFlash('error', "Personne innexistante");
        }
        return $this->redirectToRoute('personne.list.alls');        
    }

    #[Route('/stats/age/{ageMin}/{ageMax}', name: 'personne.stats.age')]
    public function statsPersonnesByAges(ManagerRegistry $doctrine, $ageMin, $ageMax): Response {
        $repository = new PersonneRepository($doctrine);
        $stats = $repository->statsPersonnesByAgeInterval($ageMin, $ageMax);
 
        return $this->render('personne/stats.html.twig', [
            'stats' => $stats[0],
            'ageMin' => $ageMin,
            'ageMax' => $ageMax
        ] );  
    }
    
    #[Route('/alls/age/{ageMin}/{ageMax}', name: 'personne.list.age')]
    public function personnesByAges(ManagerRegistry $doctrine, $ageMin, $ageMax): Response {
        $repository = new PersonneRepository($doctrine);
        $personnes = $repository->findPersonnesByAgeInterval($ageMin, $ageMax);

        return $this->render('personne/index.html.twig', [
            'personnes' => $personnes,
            'isPaginated' => true
        ] );  
    }

}
