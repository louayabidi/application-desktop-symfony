<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Participation;
use App\Form\ParticipationType;
use App\Repository\ParticipationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/participation')]
class ParticipationController extends AbstractController
{


    ////////affichage////////


    #[Route('/', name: 'app_participation_index', methods: ['GET'])]
    public function index(ParticipationRepository $participationRepository, Request $request): Response
    {
        $searchTerm = $request->query->get('search');
    
        if ($searchTerm) {
            $participations = $participationRepository->search($searchTerm);
        } else {
            $participations = $participationRepository->findAll();
        }
        


        // statistiques
    $statistics = $participationRepository->getParticipantsCountByEvent();

    return $this->render('participation/index.html.twig', [
        'participations' => $participations,
        'statistics' => $statistics, // Passer les statistiques 
    ]);
       
    }

    //////////////////recherche///////////////

    #[Route('/search', name: 'app_participation_search', methods: ['GET'])]
public function search(Request $request, ParticipationRepository $participationRepository): Response
{
    $searchTerm = $request->query->get('search');

    if ($searchTerm) {
        $participations = $participationRepository->search($searchTerm);
        $statistics = $participationRepository->getParticipantsCountByEvent();
    } else {
        $participations = [];
        $statistics = [];
    }

    return $this->render('participation/index.html.twig', [
        'participations' => $participations,
        'statistics' => $statistics,
    ]);
}



#[Route('/addparticipation', name: 'app_participation_new', methods: ['GET', 'POST'])]
public function new(Request $request, EntityManagerInterface $entityManager, ParticipationRepository $participationRepository): Response
{
   
    $idEve = $request->query->get('idEve');

  
    if (!$idEve) {
       
    }


    $evenement = $entityManager->getRepository(Evenement::class)->find($idEve);

    
    if (!$evenement) {
       
    }

  
    if ($evenement->getNbrMax() !== null && count($participationRepository->findBy(['idf_event' => $evenement->getIdEve()])) >= $evenement->getNbrMax()) {
       
        return $this->redirectToRoute('app_evenement_close');
    }


    $participation = new Participation();
    $form = $this->createForm(ParticipationType::class, $participation);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $participation->setIdfEvent($evenement);

        $entityManager->persist($participation);
        $entityManager->flush();
        return $this->redirectToRoute('app_participation_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('participation/new.html.twig', [
        'participation' => $participation,
        'form' => $form,
    ]);
}



    

    #[Route('/{idP}', name: 'app_participation_show', methods: ['GET'])]
    public function show(Participation $participation): Response
    {
        return $this->render('participation/show.html.twig', [
            'participation' => $participation,
        ]);
    }

    #[Route('/{idP}/edit', name: 'app_participation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Participation $participation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParticipationType::class, $participation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_participation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('participation/edit.html.twig', [
            'participation' => $participation,
            'form' => $form,
        ]);
    }

    #[Route('/{idP}', name: 'app_participation_delete', methods: ['POST'])]
    public function delete(Request $request, Participation $participation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participation->getIdP(), $request->request->get('_token'))) {
            $entityManager->remove($participation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_participation_index', [], Response::HTTP_SEE_OTHER);
    }




    //////trie/////////

    #[Route('/close', name: 'app_participation_close', methods: ['POST'])]
    public function close(Request $request, Participation $participation, EntityManagerInterface $entityManager): Response
    {
       

        return $this->renderForm('participation/closeevent.html.twig');
    }

  

}
