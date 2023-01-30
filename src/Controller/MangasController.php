<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Entity\Mangas;
use App\Form\MangasType;
use Doctrine\Persistence\ManagerRegistry;
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
    public function create(ManagerRegistry $doctrine): Response
    {
        $auteurs = $doctrine->getRepository(Auteur::class)->findAll();
        $form = $this->createForm(MangasType::class);

        return $this->render('mangas/create.html.twig', [
            'auteurs' => $auteurs,
            'form' => $form->createView(),
        ]);
    }
}