<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Entity\Mangas;
use App\Form\MangasType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MangasController extends AbstractController
{
    #[Route('/mangas', name: 'app_mangas')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $mangas = $doctrine->getRepository(Mangas::class)->findAll();

        return $this->render('mangas/index.html.twig', [
            'mangas' => $mangas,
        ]);
    }

    #[Route('/mangas/{id}', name: 'app_show')]
    public function show(ManagerRegistry $doctrine): Response
    {
        $mangas = $doctrine->getRepository(Mangas::class)->findAll();

        return $this->render('mangas/index.html.twig', [
            'mangas' => $mangas,
        ]);
    }

    #[Route('/create', name: 'app_create')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $auteurs = $doctrine->getRepository(Auteur::class)->findAll();
        $form = $this->createForm(MangasType::class);
        
        $manga = new Mangas();
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $doctrine->getManager();

            $data = $form->getData();

            $manga->setNom($data->getNom());
            $manga->setDateParution($data->getDateParution());
            $manga->setNbTomes($data->getNbTomes());
            $manga->setStatut($data->getStatut());
            $manga->setDescription($data->getDescription());
            $manga->setGenre($data->getGenre());
            $manga->setType($data->getType());
            $manga->setAuteurId($data->getAuteurId());
            
            $manager->persist($manga);
            $manager->flush();

            return $this->redirectToRoute('app_mangas');
        }
        
        return $this->render('mangas/create.html.twig', [
            'auteurs' => $auteurs,
            'form' => $form->createView(),
        ]);
    }
}