<?php

namespace App\Controller;

use App\Entity\Eleves;
use App\Form\ElevesFormType;
use App\Repository\ElevesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/{id}/infos', name: '_infos')]
    public function infos(Eleves $eleves, ElevesRepository $elevesRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new Eleves();
        $form = $this->createForm(ElevesFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($user);
            $entityManager->flush();
        }
        
        return $this->render('main/infos.html.twig', [
            'elevesRepository' => $elevesRepository->findBy([], ['nom' => 'ASC']),
            'eleves' => $eleves,
            'elevesForm' => $form->createView(),
        ]);
    }
}
