<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Entity\Mangas;
use DateTimeImmutable;
use App\Form\MangasType;
use App\Form\AuteursType;
use App\Entity\Commentaires;
use App\Form\CommentaireType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class MangasController extends AbstractController
{
    #[Route('/mangas', name: 'app_mangas')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

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

    #[Route('/create_mangas', name: 'app_create_mangas')]
    public function createManga(Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger): Response
    {
        $auteurs = $doctrine->getRepository(Auteur::class)->findAll();
        $form = $this->createForm(MangasType::class);
        
        $manga = new Mangas();
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $doctrine->getManager();

            $image = $form->get('image')->getData();

            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $image->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $data = $form->getData();

                $manga->setNom($data->getNom());
                $manga->setDateParution($data->getDateParution());
                $manga->setNbTomes($data->getNbTomes());
                $manga->setStatut($data->getStatut());
                $manga->setDescription($data->getDescription());
                $manga->setGenre($data->getGenre());
                $manga->setType($data->getType());
                $manga->setAuteurId($data->getAuteurId());
                $manga->setImage($data->getImage());
                
                
                $manager->persist($manga);
                $manager->flush();
    
                return $this->redirectToRoute('app_mangas');
            }

        }
        
        return $this->render('mangas/create_manga.html.twig', [
            'auteurs' => $auteurs,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/create_auteurs', name: 'app_create_auteurs')]
    public function createAuteur(Request $request, ManagerRegistry $doctrine): Response
    {
        $auteurs = $doctrine->getRepository(Auteur::class)->findAll();
        $form = $this->createForm(AuteursType::class);
        
        $auteur = new Auteur();
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $doctrine->getManager();

            $data = $form->getData();

            $auteur->setNom($data->getNom());
            $auteur->setPrenom($data->getPrenom());
            $auteur->setDateNaissance($data->getDateNaissance());
            
            $manager->persist($auteur);
            $manager->flush();

            return $this->redirectToRoute('app_mangas');
        }
        
        return $this->render('mangas/create_auteur.html.twig', [
            'auteurs' => $auteurs,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit_manga/{id}', name: 'app_edit_mangas')]
    public function editManga(Mangas $manga, Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger): Response
    {
        $auteurs = $doctrine->getRepository(Auteur::class)->findAll();
        $form = $this->createForm(MangasType::class, $manga);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $doctrine->getManager();

            $image = $form->get('image')->getData();

            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $image->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $data = $form->getData();

                $manga->setNom($data->getNom());
                $manga->setDateParution($data->getDateParution());
                $manga->setNbTomes($data->getNbTomes());
                $manga->setStatut($data->getStatut());
                $manga->setDescription($data->getDescription());
                $manga->setGenre($data->getGenre());
                $manga->setType($data->getType());
                $manga->setAuteurId($data->getAuteurId());
                $manga->setImage($newFilename);
                
                
                $manager->persist($manga);
                $manager->flush();
    
                return $this->redirectToRoute('app_mangas');
            }

        }
        
        return $this->render('mangas/edit_manga.html.twig', [
            'auteurs' => $auteurs,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit_auteur/{id}', name: 'app_edit_auteurs')]
    public function editAuteur(Auteur $auteur, Request $request, ManagerRegistry $doctrine): Response
    {
        $auteurs = $doctrine->getRepository(Auteur::class)->findAll();
        $form = $this->createForm(AuteursType::class, $auteur);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $doctrine->getManager();

            $data = $form->getData();

            $auteur->setNom($data->getNom());
            $auteur->setPrenom($data->getPrenom());
            $auteur->setDateNaissance($data->getDateNaissance());
            
            $manager->persist($auteur);
            $manager->flush();

            return $this->redirectToRoute('app_mangas');
        }
        
        return $this->render('mangas/edit_auteur.html.twig', [
            'auteurs' => $auteurs,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/show/{id}', name: 'app_show_manga')]
    public function showManga(Mangas $manga, Request $request, ManagerRegistry $doctrine, UserInterface $user): Response
    {
        $form = $this->createForm(CommentaireType::class);
        $commentaire = new Commentaires;
        $mangaId = $manga->getId();
        $commentaires = $doctrine->getRepository(Commentaires::class)->findBy(['manga_id' => $mangaId]);

        $datetime = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
        

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $doctrine->getManager();

            $data = $form->getData();

            $commentaire->setContenu($data->getContenu());
            $commentaire->setNote($data->getNote());
            $commentaire->setAuteurId($user);
            $commentaire->setMangaId($manga);
            $commentaire->setCreatedAt($datetime);
            $commentaire->setUpdatedAt($datetime);
            
            $manager->persist($commentaire);
            $manager->flush();

            return $this->redirectToRoute('app_show_manga');
        }

        return $this->render('mangas/show_manga.html.twig', [
            'manga' => $manga,
            'form' => $form->createView(),
            'commentaires' => $commentaires,
            'user' => $user,
        ]);
    }
}