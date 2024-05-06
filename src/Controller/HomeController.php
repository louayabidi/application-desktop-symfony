<?php

namespace App\Controller;

use OpenAI;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index( ? string $question, ? string $response): Response
    {
        return $this->render('evenement/chat.html.twig', [
            'question' => $question,
            'response' => $response
        ]);
    }



    #[Route('/chat', name: 'send_chat', methods:"POST")]
    public function chat(Request $request): Response
    {
        $question=$request->request->get('text');

        //Implémentation du chat gpt

        $myApiKey = $_ENV['OPENAI_KEY'];


        $client = OpenAI::client($myApiKey);

        $result = $client->completions()->create([
            'model' => 'gpt-3.5-turbo-instruct',
            'prompt' => $question,
            'max_tokens'=>2048
        ]);

        $response=$result->choices[0]->text;
  
        
        return $this->forward('App\Controller\HomeController::index', [
           
            'question' => $question,
            'response' => $response
        ]);
    }

   


}
