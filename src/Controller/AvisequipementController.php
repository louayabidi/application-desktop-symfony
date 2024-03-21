<?php

namespace App\Controller;

use App\Entity\Avisequipement;
use App\Form\AvisequipementType;
use App\Repository\AvisEquipementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/avisequipement')]
class AvisequipementController extends AbstractController
{
    #[Route('/', name: 'app_avisequipement_index', methods: ['GET'])]
    public function index(AvisEquipementRepository $avisEquipementRepository): Response
    {
        return $this->render('avisequipement/index.html.twig', [
            'avisequipements' => $avisEquipementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_avisequipement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avisequipement = new Avisequipement();
        $form = $this->createForm(AvisequipementType::class, $avisequipement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avisequipement);
            $entityManager->flush();

            return $this->redirectToRoute('app_avisequipement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avisequipement/new.html.twig', [
            'avisequipement' => $avisequipement,
            'form' => $form,
        ]);
    }

    #[Route('/{idaeq}', name: 'app_avisequipement_show', methods: ['GET'])]
    public function show(Avisequipement $avisequipement): Response
    {
        return $this->render('avisequipement/show.html.twig', [
            'avisequipement' => $avisequipement,
        ]);
    }

    #[Route('/{idaeq}/edit', name: 'app_avisequipement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Avisequipement $avisequipement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvisequipementType::class, $avisequipement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_avisequipement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avisequipement/edit.html.twig', [
            'avisequipement' => $avisequipement,
            'form' => $form,
        ]);
    }

    #[Route('/{idaeq}', name: 'app_avisequipement_delete', methods: ['POST'])]
    public function delete(Request $request, Avisequipement $avisequipement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avisequipement->getIdaeq(), $request->request->get('_token'))) {
            $entityManager->remove($avisequipement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_avisequipement_index', [], Response::HTTP_SEE_OTHER);
    }
}
