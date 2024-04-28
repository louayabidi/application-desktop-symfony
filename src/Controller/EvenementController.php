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
    public function all(EvenementRepository $evenementRepository, Request $request): Response
    {
        // Récupérer la date actuelle
        $currentDate = new \DateTime();
        
        // Récupérer tous les événements dont la date de fin est ultérieure à la date actuelle
        $evenements = $evenementRepository->findFutureEvents($currentDate);
        
        return $this->render('evenement/liste_events.html.twig', [
            'evenements' => $evenements,
        ]);
    }



    #[Route('/allback', name: 'app_evenement_indexback', methods: ['GET'])]
    public function allback(EvenementRepository $evenementRepository): Response
    {
        // Récupérer la date actuelle
        $currentDate = new \DateTime();
        
        // Récupérer tous les événements dont la date de fin est ultérieure à la date actuelle
        $evenementss = $evenementRepository->findFutureEvents($currentDate);
        
        return $this->render('evenement/table.html.twig', [
            'evenementss' => $evenementss,
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
    
            // Vérifier si un événement avec le même nom et la même date de début
            $existingEvent = $evenementRepository->findOneBy([
                'nomEve' => $evenement->getNomEve(),
                'dateDeve' => $evenement->getDateDeve()
            ]);
    
            if ($existingEvent) {
                // Afficher un message error
                $this->addFlash('error', 'Un événement avec le même nom et la même date de début existe déjà.');
                // Rediriger vers la page de création de l'événement
                return $this->redirectToRoute('app_evenement_new');
            }
    
            //  nouvel événement est unique
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



 
/*

    #[Route('/weather', name: 'app_weather')]
    public function weather(): Response
    {
        return $this->render('evenement/weather.html.twig');
    }

    #[Route('/weather-data', name: 'app_weather_data')]
    public function weatherData(Request $request): Response
    {
        $apiKey = 'be879e24600ae11dc004c73f0de0d4a1 '; 
        $city = $request->query->get('city');// Récupérer la ville depuis les paramètres GET
    
        if (empty($city)) {
            // Retourner une erreur si aucune ville n'est spécifiée
            return new Response('City parameter is missing', Response::HTTP_BAD_REQUEST);
        }
    
        // URL de l'API météo actuelle
        $currentWeatherUrl = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}";
    
        // Faire une requête à l'API
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', $currentWeatherUrl);
    
        // Vérifier le code de statut de la réponse
        if ($response->getStatusCode() === 200) {
            echo 'Requête HTTP réussie !';
        } else {
            echo 'Échec de la requête HTTP avec le code de statut : ' . $response->getStatusCode();
        }
    
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


    #[Route('/weathert', name: 'app_evenement_calendar', methods: ['GET'])]
    public function weathert(): Response
    {
        // Code météorologique
        $cache_file = 'data.json';
        if (file_exists($cache_file)) {
            $data = json_decode(file_get_contents($cache_file));
        } else {
            $api_url = 'https://content.api.nytimes.com/svc/weather/v2/current-and-seven-day-forecast.json';
            $data = file_get_contents($api_url);
            file_put_contents($cache_file, $data);
            $data = json_decode($data);
        }
    
        // Affichage de la structure des données JSON
        var_dump($data);
    
        // Affichage des données météorologiques dans la vue
        return $this->render('evenement/weather.html.twig', [
            'data' => $data,
        ]);
    }
    */

    #[Route('/weather-data', name: 'app_weather_data', methods: ['GET'])]
    public function weatherData(Request $request): Response
    {
        $city = $request->query->get('city');
        
        $api_key = 'be879e24600ae11dc004c73f0de0d4a1'; // Replace with your OpenWeatherMap API key
        $api_url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$api_key}&units=metric";
    
        $data = file_get_contents($api_url);
        $data = json_decode($data, true);
    
        if ($data['cod'] != 200) {
            return new JsonResponse(['error' => $data['message']], Response::HTTP_NOT_FOUND);
        }
    
        $current = [
            'city' => $data['name'],
            'country' => $data['sys']['country'],
            'temp' => $data['main']['temp'],
            'temp_unit' => '°C',
            'description' => $data['weather'][0]['description'],
            'icon' => $data['weather'][0]['icon'],
        ];
    
        $forecast_api_url = "https://api.openweathermap.org/data/2.5/forecast?q={$city}&appid={$api_key}&units=metric";
        $forecast_data = file_get_contents($forecast_api_url);
        $forecast_data = json_decode($forecast_data, true);
    
        $forecast = [];
        for ($i = 0; $i < count($forecast_data['list']); $i += 8) {
            $day = $forecast_data['list'][$i]['dt_txt'];
            $day = explode(' ', $day)[0];
    
            $high = $forecast_data['list'][$i]['main']['temp_max'];
            $low = $forecast_data['list'][$i]['main']['temp_min'];
    
            $forecast[] = [
                'day' => $day,
                'low' => "{$low}°C",
                'high' => "{$high}°C",
            ];
        }

        // Définir les données à passer au template
       $weatherData = [
    'current' => $current,
    'forecast' => $forecast,
];

// Passer les données au template Twig
return $this->render('evenement/weather.html.twig', $weatherData);
    }

/*
    #[Route('/calendar', name: 'app_calendar')]

    
        public function calendar():Response
        {
            return $this->render('evenement/calendar.html.twig');
        }
    
        #[Route('/evenement/events', name: 'app_evenement_get_events', methods: ['GET'])]
        public function getEvents(EvenementRepository $eventRepository): JsonResponse
        {
            $events = $eventRepository->findAll();
        
            $data = [];
            foreach ($events as $event) {
                $data[] = [
                    'idEve' => $event->getIdEve(),
                    'title' => $event->getNomEve(),
                    'start' => $event->getDateDeve()->format('Y-m-d'),
                    'end' => $event->getDateFeve() ? $event->getDateFeve()->format('Y-m-d') : null,
                ];
            }
        
            return $this->json(['data' => $data]);
        }

   */


   #[Route('/calendrier', name: 'app_evenementcale', methods: ['GET'])]
   public function calendar(EvenementRepository $calendar): Response
   {
       $evenement = $calendar->findAll();
   
       $rdvs = [];
   
       foreach($evenement as $event){
           $rdvs[] = [
               'id' => $event->getIdEve(),
               'start' => $event->getDateDeve()->format('Y-m-d'),
               'end' => $event->getDateFeve()->format('Y-m-d'),
               'title' => $event->getNomEve(),
               'backgroundColor' => '#fcb97e',
               'borderColor' => '#fba22e',
           ];
       }
   
       $data = json_encode($rdvs);
   
       return $this->render('evenement/calendar.html.twig', compact('data'));
   }



   #[Route('/close', name: 'app_evenement_close', methods: ['GET'])]
   public function close(): Response
   {
       return $this->render('evenement/close.html.twig');
   }




   #[Route('/archive', name: 'app_evenement_archive', methods: ['GET'])]
public function archive(EvenementRepository $evenementRepository, Request $request): Response
{
    // Vérifier si un terme de recherche est spécifié dans la requête
    $searchTerm = $request->query->get('q');

    if ($searchTerm) {
        // Rechercher les événements archivés correspondants dans la base de données
        $resultatsRecherche = $evenementRepository->search($searchTerm);

        // Rendre la vue avec les résultats de la recherche
        return $this->render('evenement/archive.html.twig', [
            'resultatsRecherche' => $resultatsRecherche,
        ]);
    }

    // Si aucun terme de recherche n'est spécifié, afficher tous les événements archivés
    $archivedEvents = $evenementRepository->findArchivedEvents();
    
    return $this->render('evenement/archive.html.twig', [
        'archivedEvents' => $archivedEvents,
    ]);
}


   


   #[Route('/search', name: 'app_evenement_search', methods: ['GET'])]
public function search(Request $request, EvenementRepository $evenementRepository): Response
{
    // Récupérer le terme de recherche depuis la requête
    $searchTerm = $request->query->get('q');

    // Rechercher les événements correspondants dans la base de données
    $resultatsRecherche = $evenementRepository->search($searchTerm);

    // Rendre la vue avec les résultats de la recherche
    return $this->render('evenement/table.html.twig', [
        'resultatsRecherche' => $resultatsRecherche,
    ]);
}


#[Route('/sort-all', name: 'sort_events_all_attributes')]
public function sortEventsByAllAttributes(Request $request, EvenementRepository $evenementRepository): Response
{
    // Récupérer l'attribut sélectionné depuis la requête
    $sortAttribute = $request->query->get('sortAttribute');

    // Vérifier si l'attribut est valide
    $validAttributes = ['nomEve', 'dateDeve', 'dateFeve', 'adresseEve', 'nbrMax'];
    if (!in_array($sortAttribute, $validAttributes)) {
        throw new \InvalidArgumentException("L'attribut spécifié n'est pas valide.");
    }

    // Trier les événements par l'attribut spécifié
    $sortedEvents = $evenementRepository->sortByAllAttributes($sortAttribute);

    // Faites quelque chose avec les événements triés...

    return $this->render('evenement/table.html.twig', [
        'evenementss' => $sortedEvents,
    ]);
}

}