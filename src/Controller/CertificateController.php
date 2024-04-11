<?php

namespace App\Controller;

require_once 'C:\Users\louay\webpidev\web-app-main\includes\dompdf\autoload.inc.php';

use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Participation;
use Dompdf\Options;


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

    // Créer un objet Dompdf pour générer le certificat
    $dompdf = new Dompdf();

    // Load the background image
    $backgroundImage = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/certificat_image/Certificate.png');

    // HTML du certificat avec image de fond
    $html = "
    <style>
        .background {
            background-image: url('data:image/png;base64, " . base64_encode($backgroundImage) . "');
            background-size: cover;
            background-position: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        .content {
            text-align: center;
            margin-top: 100px;
            position: relative;
            z-index: 1;
            
        }
    </style>
    <body>
        <div class='background'></div>
        <div class='content'>
            <h1>Certificat de participation</h1>
            <h1> $eventName</h1>
            <h1>             </h1>
            <h1>             </h1>
            <h1>             </h1>
            <h1>             </h1>
            <h1>             </h1>
            <h1>             </h1>
            <h1>             </h1>
            <h1>             </h1>
            <h1>             </h1>
            <h1>             </h1>
            <h1>             </h1>
            <h2>Participant : $participantName</h2>
            
        </div>
    </body>
";
    // Charger le HTML dans Dompdf
    $dompdf->loadHtml($html);

    // Rendre le PDF
    $dompdf->render();

    // Retourner le PDF en tant que réponse
    return new Response($dompdf->output(), 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="certificate.pdf"'
    ]);
}
}