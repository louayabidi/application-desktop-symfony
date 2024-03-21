<?php

namespace App\Controller;

use App\Entity\Avisp;
use App\Form\AvispType;
use App\Repository\AvispRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/avisp')]
class AvispController extends AbstractController
{
    #[Route('/', name: 'app_avisp_index', methods: ['GET'])]
    public function index(AvispRepository $avispRepository): Response
    {
        return $this->render('avisp/index.html.twig', [
            'avisps' => $avispRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_avisp_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avisp = new Avisp();
        $form = $this->createForm(AvispType::class, $avisp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avisp);
            $entityManager->flush();

            return $this->redirectToRoute('app_avisp_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avisp/new.html.twig', [
            'avisp' => $avisp,
            'form' => $form,
        ]);
    }

    #[Route('/{idap}', name: 'app_avisp_show', methods: ['GET'])]
    public function show(Avisp $avisp): Response
    {
        return $this->render('avisp/show.html.twig', [
            'avisp' => $avisp,
        ]);
    }

    #[Route('/{idap}/edit', name: 'app_avisp_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Avisp $avisp, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvispType::class, $avisp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_avisp_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avisp/edit.html.twig', [
            'avisp' => $avisp,
            'form' => $form,
        ]);
    }

    #[Route('/{idap}', name: 'app_avisp_delete', methods: ['POST'])]
    public function delete(Request $request, Avisp $avisp, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avisp->getIdap(), $request->request->get('_token'))) {
            $entityManager->remove($avisp);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_avisp_index', [], Response::HTTP_SEE_OTHER);
    }
}
