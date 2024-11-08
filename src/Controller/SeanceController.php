<?php

namespace App\Controller;

use App\Entity\Seance;
use App\Form\SeanceType;
use App\Repository\SeanceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
#[Route('/seance')]
class SeanceController extends AbstractController
{
    #[Route('/', name: 'app_seance_index', methods: ['GET'])]
    public function index(SeanceRepository $seanceRepository): Response
    {
        return $this->render('seance/index.html.twig', [
            'seances' => $seanceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_seance_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $seance = new Seance();
        $form = $this->createForm(SeanceType::class, $seance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($seance);
            $entityManager->flush();

            return $this->redirectToRoute('app_seance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('seance/new.html.twig', [
            'seance' => $seance,
            'form' => $form,
        ]);
    }

    #[Route('/{idseance}', name: 'app_seance_show', methods: ['GET'])]
    public function show(Seance $seance): Response
    {
        return $this->render('seance/show.html.twig', [
            'seance' => $seance,
        ]);
    }

    #[Route('/{idseance}/edit', name: 'app_seance_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Seance $seance, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SeanceType::class, $seance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_seance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('seance/edit.html.twig', [
            'seance' => $seance,
            'form' => $form,
        ]);
    }

    #[Route('/{idseance}', name: 'app_seance_delete', methods: ['POST'])]
    public function delete(Request $request, Seance $seance, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seance->getIdseance(), $request->request->get('_token'))) {
            $entityManager->remove($seance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_seance_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/{idseance}/seanceimage', name: 'seanceimage')]
    public function imageseance(SeanceRepository $seanceRepository): Response
    {    // Récupérer toutes les entrées de la table seance
        $seances = $seanceRepository->findAll();

        // Tableau pour stocker les chemins des images
        $images = [];

        // Parcourir toutes les entrées de la table seance et extraire les chemins des images
        foreach ($seances as $seance) {
            // Vérifier si le champ imageseance contient un chemin d'image non vide
            if ($seance->getImageseance() !== null) {
                // Ajouter le chemin de l'image au tableau des images
                $images[] = $seance->getImageseance();
            }
        }

        return $this->render('seance/index.html.twig', [
            'images' => $images, // Passer le tableau des chemins d'images à la vue Twig
        ]);
    }
    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
     //  return new Response("the about page");
     return $this->redirectToRoute('app_about', [], Response::HTTP_SEE_OTHER);
    }

}
