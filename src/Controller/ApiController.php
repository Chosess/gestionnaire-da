<?php

namespace App\Controller;

use App\Entity\Eleves;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api/{id}', name: 'api_data')]
    public function index(Eleves $eleves): Response
    {
        
        // $test = [];
        // foreach($eleves as $eleve){
        //     foreach($eleve as $info){
        //         $eleve[] = $info;
        //     }
        //     var_dump($eleve);
            
        //     $test[] = $eleve;
        // }

        dd($eleves);

        return new JsonResponse($eleves);
    }
}
