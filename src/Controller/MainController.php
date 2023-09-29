<?php

namespace App\Controller;

use App\Entity\Eleves;
use App\Repository\ElevesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/accueil', name: 'app_main')]
    public function index(ElevesRepository $elevesRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'elevesRepository' => $elevesRepository->findBy([], 
            ['nom' => 'ASC']
            )
        ]);
    }

    #[Route('/{id}/infos', name: 'app_main')]
    public function infos(Eleves $eleves, ElevesRepository $elevesRepository): Response
    {
        return $this->render('main/infos.html.twig', [
            'elevesRepository' => $elevesRepository->findBy([], ['nom' => 'ASC']),
            'eleves' => $eleves
        ]);
    }
}
