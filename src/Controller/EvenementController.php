<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/evenement')]
class EvenementController extends AbstractController
{

    //afficher tous 
    #[Route('/all', name: 'app_evenement_index', methods: ['GET'])]
    public function all(EvenementRepository $evenementRepository): Response
    {
        return $this->render('evenement/liste_events.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_evenement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer le fichier téléchargé
            $imageFile = $form->get('imageEve')->getData();
    
            // Vérifier si un fichier a été téléchargé
            if ($imageFile) {
                // Donner un nom unique au fichier
                $newFilename = uniqid().'.'.$imageFile->guessExtension();
    
                // Déplacer le fichier vers le répertoire où vous souhaitez stocker les images des événements
                try {
                    $imageFile->move(
                        $this->getParameter('evenement_images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Gérer l'erreur si le déplacement du fichier échoue
                }
    
                // Stocker le nom du fichier dans la base de données
                $evenement->setImageEve($newFilename);
            }
    
            $entityManager->persist($evenement);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }

    #[Route('/{idEve}', name: 'app_evenement_show', methods: ['GET'])]
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    #[Route('/{idEve}/edit', name: 'app_evenement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }

    #[Route('/{idEve}', name: 'app_evenement_delete', methods: ['POST'])]
    public function delete(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getIdEve(), $request->request->get('_token'))) {
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
    }


    //liste avec images 

  /*  #[Route('/all-events', name: 'app_evenement_all_events', methods: ['GET'])]
    public function allEvents(EvenementRepository $evenementRepository): Response
    {
        $evenements = $evenementRepository->findAll();
    
        return $this->render('evenement/liste_events.html.twig', [
            'evenements' => $evenements,
        ]);
    }*/








}

