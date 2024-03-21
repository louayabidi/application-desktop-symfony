<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class TemplatesControllerBack extends AbstractController
{
    #[Route('/rb', name: 'app_reservationb')]
    public function reservation(): Response
    {
        // Rendu du template reservation.html.twig
        return $this->render('reservation/reservationback.html.twig');
    }
    #[Route('/dashbord', name: 'app_dashbordb')]
    public function accueil(): Response
    {
        // Rendu du template reservation.html.twig
        return $this->render('back.html.twig');
    }

    #[Route('/eqb', name: 'app_equipementb')]
    public function equipement(): Response
    {
        // Rendu du template reservation.html.twig
        return $this->render('equipement/equipementback.html.twig');
    }
    #[Route('/abb', name: 'app_abonnementb')]
    public function abonnement(): Response
    {
        // Rendu du template reservation.html.twig
        return $this->render('abonnement/abonnementback.html.twig');
    }
    #[Route('/alimentaireb', name: 'app_alimentaireb')]
    public function alimentaire(): Response
    {
        // Rendu du template reservation.html.twig
        return $this->render('plat/alimentaireback.html.twig');
    }
    #[Route('/eveb', name: 'app_evenementb')]
    public function evenement(): Response
    {
        // Rendu du template reservation.html.twig
        return $this->render('evenement/evenementback.html.twig');
    }
    #[Route('/recb', name: 'app_reclamationb')]
    public function reclamation(): Response
    {
        // Rendu du template reservation.html.twig
        return $this->render('reclamation/reclamationback.html.twig');
    }
}

