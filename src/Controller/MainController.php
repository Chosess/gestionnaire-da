<?php

namespace App\Controller;

use App\Entity\Eleves;
use App\Entity\Transports;
use App\Form\ElevesFormType;
use App\Repository\ElevesRepository;
use App\Service\PictureService;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/accueil', name: 'app_main')]
    public function index( ElevesRepository $elevesRepository, Request $request, EntityManagerInterface $entityManager, PictureService $pictureService): Response
    {
        $eleves = new Eleves;

        $form = $this->createForm(ElevesFormType::class, $eleves);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // on récupère le fichier envoyer dans le champ 'photo'
            $image = $form->get('photo')->getData();

            // on vérifie qu'il y ait un fichier envoyé
            if (!empty($image)) {

                $folder = 'image';

                // on récupère l'ancienne photo
                $previmage = $eleves->getPhoto();

                // on supprime l'ancienne photo de profil
                $pictureService->delete($previmage, $folder);

                // on ajoute la nouvelle photo de profil
                $fichier = $pictureService->add($image, $folder, 300, 300);

                $eleves->setPhoto($fichier);

            }

            // ajouter un transport 
            $newtransport = $form->get('newtransport')->getData();

            if (!empty($newtransport)) {
                $nouvelleEntite = new Transports();
                $nouvelleEntite->setTransport($newtransport);
                $eleves->addTransport($nouvelleEntite);
                $entityManager->persist($nouvelleEntite);
            }

            // enlever un transport
            $removetransport = $form->get('transports')->getData();
            
            if(!empty($removetransport)){
                foreach($removetransport as $rt){
                    $rt->setEleves(null);
                    $entityManager->remove($rt);
                }
            }

            // la date de naissance
            $date = $form->get('date_naissance')->getData();
            
            $date = DateTime::createFromFormat("d/m/Y",$date);

            if(!empty($date)){
                $eleves->setDateNaissance($date);
            }

            // la date d'inscription
            $inscri = $eleves->isValidationInscription();
            $inscription = $form->get('validation_inscription')->getData();

            if($inscription == true && $inscri == false){
                $fuseauHoraire = new DateTimeZone('Europe/Paris');
                $dateActuelle = new DateTime('now', $fuseauHoraire);
                $eleves->setValidationInscription(true);
            }



            $entityManager->persist($eleves);
            $entityManager->flush();
        }


        //dn = date de naissance
        $dn = $eleves->getDateNaissance();
        if(!empty($dn)){
            $dn = $dn->format('d/m/Y');
        }

        //di = date d'inscription
        $inscri = $eleves->isValidationInscription();
        $di = $eleves->getDateInscription();
        if(!empty($di) && $inscri == true){
            $di = $di->format('d/m/Y');
        } else {
            $di = '';
        }

        return $this->render('main/eleve.html.twig', [
            'elevesRepository' => $elevesRepository->findBy([], ['nom' => 'ASC']),
            'elevesForm' => $form->createView(),
        ]);
    }

    #[Route('/{id}/infos', name: '_infos')]
    public function infos(Eleves $eleves, ElevesRepository $elevesRepository, Request $request, EntityManagerInterface $entityManager, PictureService $pictureService): Response
    {
        $form = $this->createForm(ElevesFormType::class, $eleves);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // on récupère le fichier envoyer dans le champ 'photo'
            $image = $form->get('photo')->getData();

            // on vérifie qu'il y ait un fichier envoyé
            if (!empty($image)) {

                $folder = 'image';

                // on récupère l'ancienne photo
                $previmage = $eleves->getPhoto();

                // on supprime l'ancienne photo de profil si elle existe
                if(!empty($previmage)){
                    $pictureService->delete($previmage, $folder);
                }


                // on ajoute la nouvelle photo de profil
                $fichier = $pictureService->add($image, $folder, 300, 300);

                $eleves->setPhoto($fichier);

            }

            // ajouter un transport 
            $newtransport = $form->get('newtransport')->getData();

            if (!empty($newtransport)) {
                $nouvelleEntite = new Transports();
                $nouvelleEntite->setTransport($newtransport);
                $eleves->addTransport($nouvelleEntite);
                $entityManager->persist($nouvelleEntite);
            }

            // enlever un transport
            $removetransport = $form->get('transports')->getData();
            
            if(!empty($removetransport)){
                foreach($removetransport as $rt){
                    $rt->setEleves(null);
                    $entityManager->remove($rt);
                }
            }

            // la date de naissance
            $date = $form->get('date_naissance')->getData();
            
            $date = DateTime::createFromFormat("d/m/Y",$date);

            if(!empty($date)){
                $eleves->setDateNaissance($date);
            }

            // la date d'inscription
            $inscri = $eleves->isValidationInscription();
            $inscription = $form->get('validation_inscription')->getData();

            if($inscription == true && $inscri == false){
                $fuseauHoraire = new DateTimeZone('Europe/Paris');
                $dateActuelle = new DateTime('now', $fuseauHoraire);
                $eleves->setValidationInscription(true);
            }



            $entityManager->persist($eleves);
            $entityManager->flush();
        }


        //dn = date de naissance
        $dn = $eleves->getDateNaissance();
        if(!empty($dn)){
            $dn = $dn->format('d/m/Y');
        }

        //di = date d'inscription
        $inscri = $eleves->isValidationInscription();
        $di = $eleves->getDateInscription();
        if(!empty($di) && $inscri == true){
            $di = $di->format('d/m/Y');
        } else {
            $di = '';
        }

        return $this->render('main/infos.html.twig', [
            'elevesRepository' => $elevesRepository->findBy([], ['nom' => 'ASC']),
            'eleves' => $eleves,
            'dn' => $dn,
            'di' => $di,
            'elevesForm' => $form->createView(),
        ]);
    }

    #[Route('//{id}/documents', name: '_documents')]
    public function documents(Eleves $eleves, ElevesRepository $elevesRepository): Response
    {
        return $this->render('main/documents.html.twig', [
            'elevesRepository' => $elevesRepository->findBy([], ['nom' => 'ASC']),
            'eleves' => $eleves
        ]);
    }
}
