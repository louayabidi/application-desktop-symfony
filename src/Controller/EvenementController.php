<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


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



    #[Route('/allback', name: 'app_evenement_indexback', methods: ['GET'])]
    public function allback(EvenementRepository $evenementRepository): Response
    {
        return $this->render('evenement/table.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);
    }


    #[Route('/new', name: 'app_evenement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, EvenementRepository $evenementRepository): Response
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
    
            // Vérifier si un événement avec le même nom et la même date de début existe déjà
            $existingEvent = $evenementRepository->findOneBy([
                'nomEve' => $evenement->getNomEve(),
                'dateDeve' => $evenement->getDateDeve()
            ]);
    
            if ($existingEvent) {
                // Afficher un message d'erreur
                $this->addFlash('error', 'Un événement avec le même nom et la même date de début existe déjà.');
                // Rediriger vers la page de création de l'événement
                return $this->redirectToRoute('app_evenement_new');
            }
    
            // Le nouvel événement est unique, procéder à la persistance
            $entityManager->persist($evenement);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }



/*    #[Route('/{idEve}', name: 'app_evenement_show', methods: ['GET'])]
public function show(#[ParamConverter('evenement', options: ['mapping' => ['idEve' => 'idEve']])] Evenement $evenement): Response
{
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }
*/


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

        return $this->redirectToRoute('app_evenement_indexback', [], Response::HTTP_SEE_OTHER);
    }
    
   



    #[Route('/evenement/{idEve}', name: 'app_evenement_show')]
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }



    #[Route('/calendar', name: 'app_evenement_calendar', methods: ['GET'])]
    public function calendar(): Response
    {
        $httpClient = HttpClient::create();
        $url = 'http://exemple.com/api';
        $response = $httpClient->request('GET', '$url');
        $events = $response->toArray();

        return $this->render('evenement/calendar.html.twig', [
            'events' => $events,
        ]);
    }


    #[Route('/weather', name: 'app_weather')]
    public function weather(): Response
    {
        return $this->render('evenement/weather.html.twig');
    }

    #[Route('/weather-data', name: 'app_weather_data')]
    public function weatherData(): Response
    {
        $apiKey = 'be879e24600ae11dc004c73f0de0d4a1        '; // Remplacer par votre clé API OpenWeatherMap
        $city = $_GET['city'] ?? ''; // Récupérer la ville depuis les paramètres GET

        if (empty($city)) {
            // Retourner une erreur si aucune ville n'est spécifiée
            return new Response('City parameter is missing', Response::HTTP_BAD_REQUEST);
        }

        // URL de l'API météo actuelle
        $currentWeatherUrl = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}";

        // Faire une requête à l'API
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', $currentWeatherUrl);

        // Vérifier si la requête a réussi
        if ($response->getStatusCode() === Response::HTTP_OK) {
            // Récupérer les données de réponse au format JSON
            $data = $response->toArray();

            // Convertir la température en degrés Celsius
            $temperature = round($data['main']['temp'] - 273.15);

            // Préparer les données à renvoyer au format JSON
            $weatherData = [
                'city' => $data['name'],
                'temperature' => $temperature,
                'description' => $data['weather'][0]['description'],
                'icon' => $data['weather'][0]['icon']
            ];

            // Convertir les données en JSON et les renvoyer
            return $this->json($weatherData);
        }

        // En cas d'erreur, retourner un message d'erreur
        return new Response('Error fetching weather data', $response->getStatusCode());
    }
}

    


