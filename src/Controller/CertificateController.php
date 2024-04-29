<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Participation;
use TCPDF;

class CertificateController extends AbstractController
{
    #[Route('/generate-certificate/{idP}', name: 'app_generate_certificate')]
    public function generateCertificate($idP): Response
    {
        // Récupérer le participant à partir de son ID
        $participation = $this->getDoctrine()->getRepository(Participation::class)->find($idP);

        // Vérifier si le participant existe
        if (!$participation) {
            throw $this->createNotFoundException('Participant non trouvé');
        }

        // Récupérer les informations spécifiques à cette participation
        $participantName = $participation->getNomP() . ' ' . $participation->getPrenomP();
        $eventName = $participation->getIdfEvent()->getNomEve();

        // Créer un objet TCPDF pour générer le certificat
        $pdf = new TCPDF();

        // Ajouter une page
        $pdf->AddPage();

        // Charger l'image de fond et la faire couvrir toute la page
        $backgroundImage = 'C:\Users\louay\webpidev\web-app-main\public\certificat_image\Certificate.png'; // Chemin vers votre image de fond
        $pdf->Image($backgroundImage, 10, 10, $pdf->getPageWidth(), $pdf->getPageHeight(), '', '', '', false, 400, '', false, false, 0);

        // Définir la police et la taille de la police
        $pdf->SetFont('helvetica', '', 20);

        // Centrer le texte horizontalement et verticalement
        $pdf->SetXY(0, 70);
 
        $pdf->Cell(0, 0, "Certificat de participation", 0, 0, 'C');
        $pdf->Ln(10);

        $pdf->Cell(0, 0, $eventName, 0, 0, 'C');
        $pdf->Ln(10);
        $pdf->SetXY(0, 135);
        $pdf->Cell(0, 0, " $participantName", 0, 0, 'C');

        // Retourner le PDF en tant que réponse
        return new Response($pdf->Output('certificate.pdf', 'I'), 300, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}