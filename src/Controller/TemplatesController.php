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
class TemplatesController extends AbstractController
{
    #[Route('/r', name: 'app_reservation')]
    public function reservation(): Response
    {
        // Rendu du template reservation.html.twig
        return $this->render('reservation/reservation.html.twig');
    }
    #[Route('/accueil', name: 'app_accueil')]
    public function accueil(): Response
    {
        // Rendu du template reservation.html.twig
        return $this->render('base.html.twig');
    }
    #[Route('/apropos', name: 'app_apropos')]
    public function apropos(): Response
    {
        // Rendu du template reservation.html.twig
        return $this->render('apropos.html.twig');
    }
    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        // Rendu du template reservation.html.twig
        return $this->render('contact.html.twig');
    }
    #[Route('/eq', name: 'app_equipement')]
    public function equipement(): Response
    {
        // Rendu du template reservation.html.twig
        return $this->render('equipement/equipement.html.twig');
    }
    #[Route('/ab', name: 'app_abonnement')]
    public function abonnement(): Response
    {
        // Rendu du template reservation.html.twig
        return $this->render('abonnement/abonnement.html.twig');
    }
    #[Route('/alimentaire', name: 'app_alimentaire')]
    public function alimentaire(): Response
    {
        // Rendu du template reservation.html.twig
        return $this->render('plat/alimentaire.html.twig');
    }
    #[Route('/eve', name: 'app_evenement')]
    public function evenement(): Response
    {
        // Rendu du template reservation.html.twig
        return $this->render('evenement/evenement.html.twig');
    }
    #[Route('/rec', name: 'app_reclamation')]
    public function reclamation(): Response
    {
        // Rendu du template reservation.html.twig
        return $this->render('reclamation/reclamation.html.twig');
    }
}

