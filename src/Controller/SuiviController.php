<?php

namespace App\Controller;

use App\Entity\Eleves;
use App\Repository\ElevesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SuiviController extends AbstractController
{
    #[Route('//{id}/suivi', name: '_suivi')]
    public function suivi(Eleves $eleves, ElevesRepository $elevesRepository): Response
    {
        return $this->render('main/suivi.html.twig', [
            'elevesRepository' => $elevesRepository->findBy([], ['nom' => 'ASC']),
            'eleves' => $eleves
        ]);
    }
}

