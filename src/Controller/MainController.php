<?php

namespace App\Controller;

use App\Entity\Eleves;
use App\Form\ElevesFormType;
use App\Repository\ElevesRepository;
use App\Service\ImageService;
use App\Service\PictureService;
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
    public function infos(Eleves $eleves, ElevesRepository $elevesRepository, Request $request, EntityManagerInterface $entityManager, PictureService $pictureService): Response
    {
        // $eleves = new Eleves();
        $form = $this->createForm(ElevesFormType::class, $eleves);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // on récupère le fichier envoyer dans le champ 'photo'
            $image = $form->get('photo')->getData();

            $folder = 'image';

            // on récupère l'ancienne photo
            $previmage = $eleves->getPhoto();

            // on supprime l'ancienne photo de profil
            $pictureService->delete($previmage, $folder);

            // on ajoute la nouvelle photo de profil
            $fichier = $pictureService->add($image, $folder, 300, 300);

            $eleves->setPhoto($fichier);

            $entityManager->persist($eleves);
            $entityManager->flush();
        }
        
        return $this->render('main/infos.html.twig', [
            'elevesRepository' => $elevesRepository->findBy([], ['nom' => 'ASC']),
            'eleves' => $eleves,
            'elevesForm' => $form->createView(),
        ]);
    }
}
