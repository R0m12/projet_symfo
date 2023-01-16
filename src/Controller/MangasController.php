<?php

namespace App\Controller;

use App\Entity\Mangas;
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
        var_dump($mangas);

        return $this->render('mangas/index.html.twig', [
            'mangas' => $mangas,
        ]);
    }
}