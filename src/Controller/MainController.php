<?php

namespace App\Controller;

use App\Entity\Eleves;
use App\Entity\Transports;
use App\Form\ElevesFormType;
use App\Repository\ElevesRepository;
use App\Repository\TransportsRepository;
use App\Service\ChiffrementService;
use App\Service\PictureService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

class MainController extends AbstractController
{
    #[Route('/accueil', name: 'app_main')]
    public function index(Eleves $eleves, ElevesRepository $elevesRepository, Request $request, EntityManagerInterface $entityManager, PictureService $pictureService, RouterInterface $routerInterface, Security $security): Response
    {
        // on redirige l'utilisateur si il n'est pas connecté
        $user = $security->getUser();

        if (empty($user)) {
            return $this->redirectToRoute('app_login');
        }

        $eleve = new Eleves;

        $form = $this->createForm(ElevesFormType::class, $eleve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // on récupère le fichier envoyer dans le champ 'photo'
            $image = $form->get('photo')->getData();

            // on vérifie qu'il y ait un fichier envoyé
            if (!empty($image)) {

                $folder = 'image';

                // on ajoute la nouvelle photo de profil
                $fichier = $pictureService->add($image, $folder);

                $eleve->setPhoto($fichier);
            }

            // ajouter un transport 
            $newtransport = $form->get('newtransport')->getData();

            if (!empty($newtransport)) {
                $nouvelleEntite = new Transports();
                $nouvelleEntite->setTransport($newtransport);
                $eleve->addTransport($nouvelleEntite);
                $entityManager->persist($nouvelleEntite);
            }

            // enlever un transport
            $removetransport = $form->get('removetransports')->getData();

            if (!empty($removetransport)) {
                foreach ($removetransport as $rt) {
                    $rt->setEleves(null);
                    $entityManager->remove($rt);
                }
            }

            // la date de naissance
            $date = $form->get('date_naissance')->getData();

            $date = DateTime::createFromFormat("d/m/Y", $date);

            if (!empty($date)) {
                $eleve->setDateNaissance($date);
            }

            // la date d'inscription
            $dateinscription = $form->get('date_inscription')->getData();

            $dateinscription = DateTime::createFromFormat("d/m/Y", $dateinscription);

            if (!empty($dateinscription)) {
                $eleve->setDateInscription($dateinscription);
            }

            // la date de fin de suivi
            $datefin = $form->get('date_fin_suivi')->getData();

            $datefin = DateTime::createFromFormat("d/m/Y", $datefin);

            if (!empty($datefin)) {
                $eleve->setDateFinSuivi($datefin);
            }

            // la date de cotisations
            $cotisationsdate = $form->get('cotisations_date')->getData();

            $cotisationsdate = DateTime::createFromFormat("d/m/Y", $cotisationsdate);

            if (!empty($cotisationsdate)) {
                $eleves->setCotisationsDate($cotisationsdate);
            }

            // la date de début de stage
            $stagedebut = $form->get('stage_debut')->getData();

            $stagedebut = DateTime::createFromFormat("d/m/Y", $stagedebut);

            if (!empty($stagedebut)) {
                $eleves->setStageDebut($stagedebut);
            }

            // la date de début de stage
            $stagefin = $form->get('stage_fin')->getData();

            $stagefin = DateTime::createFromFormat("d/m/Y", $stagefin);

            if (!empty($stagefin)) {
                $eleves->setStageFin($stagefin);
            }

            // la date du CNED
            $dateCNED = $form->get('date_cned')->getData();

            $dateCNED = DateTime::createFromFormat("d/m/Y", $dateCNED);

            if (!empty($dateCNED)) {
                $eleves->setDateCned($dateCNED);
            }

            // la date d'incription au CNED
            $inscriptionCNED = $form->get('date_inscription_cned')->getData();

            $inscriptionCNED = DateTime::createFromFormat("d/m/Y", $inscriptionCNED);

            if (!empty($inscriptionCNED)) {
                $eleves->setDateInscriptionCned($inscriptionCNED);
            }

            // le dipositif d'aide
            $dispositif = $form->get('dispositif_aide')->getData();
            $valeurdispositif = $form->get('valeur_dispositif')->getData();

            if ($dispositif == 'Autre' && !empty($valeurdispositif)) {
                $eleves->setDispositifAide($valeurdispositif);
            }

            // on converti les nombre en int pour enfants, montant et annee_formation
            $enfants = $form->get('enfants')->getData();
            if (!empty($enfants)) {
                $eleves->setEnfants(intval($enfants));
            }
            $montant = $form->get('montant')->getData();
            if (!empty($montant)) {
                $eleves->setMontant(intval($montant));
            }
            $anneeFormation = $form->get('annee_formation')->getData();
            if (!empty($anneeFormation)) {
                $eleves->setAnneeFormation(intval($anneeFormation));
            }


            $entityManager->persist($eleve);
            $entityManager->flush();

            $route = $routerInterface->generate('_infos', ['id' => $eleve->getId()]);
            return new RedirectResponse($route);
        }

        return $this->render('main/eleve/eleve.html.twig', [
            'elevesRepository' => $elevesRepository->findBy([], ['nom' => 'ASC']),
            'eleves' => $eleves,
            'user' => $user,
            'elevesForm' => $form->createView(),
        ]);
    }

    #[Route('/{id}/infos', name: '_infos')]
    public function infos(Eleves $eleves, ElevesRepository $elevesRepository, Request $request, EntityManagerInterface $entityManager, PictureService $pictureService, TransportsRepository $transportsRepository, Security $security, ChiffrementService $chiffrementService): Response
    {
        // on redirige l'utilisateur si il n'est pas connecté
        $user = $security->getUser();

        if (empty($user)) {
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(ElevesFormType::class, $eleves);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formData = $form->all();
            foreach ($formData as $data) {
                if (!empty($data->getData()) && $data->getName() != 'photo' && $data->getName() != 'newtransport' && $data->getName() != 'removetransports' && $data->getName() != 'date_naissance' && $data->getName() != 'date_inscription' && $data->getName() != 'date_fin_suivi' && $data->getName() != 'cotisations_date' && $data->getName() != 'stage_debut' && $data->getName() != 'stage_fin' && $data->getName() != 'dispositif_aide' && $data->getName() != 'valeur_dispositif' && $data->getName() != 'enfants' && $data->getName() != 'annee_formation' && $data->getName() != 'educateurs_id' && $data->getName() != 'date_cned' && $data->getName() != 'date_inscription_cned' && $data->getName() != 'montant' && $data->getName() != 'civilite') {
                    // on récupère le nom du champ et on le transforme pour pouvoir faire un setNomDuChamp
                    $test = strtolower($data->getName());
                    $test = explode('_', $test);
                    $maj = [];
                    foreach ($test as $tes) {
                        $tes = ucfirst($tes);
                        $maj[] = $tes;
                    }
                    $test = 'set' . join($maj);
                    // on chiffre l'information
                    $info = $chiffrementService->encode($data->getData());
                    $eleves->$test($info);
                }
            }

            // on récupère le fichier envoyer dans le champ 'photo'
            $image = $form->get('photo')->getData();

            // on vérifie qu'il y ait un fichier envoyé
            if (!empty($image)) {

                $folder = 'image';

                // on récupère l'ancienne photo
                $previmage = $eleves->getPhoto();

                // on supprime l'ancienne photo de profil si elle existe
                if (!empty($previmage)) {
                    $pictureService->delete($previmage, $folder);
                }


                // on ajoute la nouvelle photo de profil
                $fichier = $pictureService->add($image, $folder);

                $eleves->setPhoto($fichier);
            }

            // ajouter un transport 
            $newtransport = $form->get('newtransport')->getData();

            if (!empty($newtransport)) {
                $nouvelleEntite = new Transports();
                $nouvelleEntite->setTransport($chiffrementService->encode($newtransport));
                $eleves->addTransport($nouvelleEntite);
                $entityManager->persist($nouvelleEntite);
            }

            // enlever un transport
            $removetransports = $form->get('removetransports')->getData();
            if (!empty($removetransports)) {
                foreach (explode(',', $removetransports) as $removetransport) {
                    $transport = $transportsRepository->findOneBy(['id' => $removetransport]);
                    $transport->setEleves(null);
                    $entityManager->remove($transport);
                }
            }


            // la date de naissance
            $date = $form->get('date_naissance')->getData();

            $date = DateTime::createFromFormat("d/m/Y", $date);

            if (!empty($date)) {
                $eleves->setDateNaissance($date);
            }

            // la date d'inscription
            $dateinscription = $form->get('date_inscription')->getData();

            $dateinscription = DateTime::createFromFormat("d/m/Y", $dateinscription);

            if (!empty($dateinscription)) {
                $eleves->setDateInscription($dateinscription);
            }

            // la date de fin de suivi
            $datefin = $form->get('date_fin_suivi')->getData();

            $datefin = DateTime::createFromFormat("d/m/Y", $datefin);

            if (!empty($datefin)) {
                $eleves->setDateFinSuivi($datefin);
            }

            // la date de cotisations
            $cotisationsdate = $form->get('cotisations_date')->getData();

            $cotisationsdate = DateTime::createFromFormat("d/m/Y", $cotisationsdate);

            if (!empty($cotisationsdate)) {
                $eleves->setCotisationsDate($cotisationsdate);
            }

            // la date de début de stage
            $stagedebut = $form->get('stage_debut')->getData();

            $stagedebut = DateTime::createFromFormat("d/m/Y", $stagedebut);

            if (!empty($stagedebut)) {
                $eleves->setStageDebut($stagedebut);
            }

            // la date de début de stage
            $stagefin = $form->get('stage_fin')->getData();

            $stagefin = DateTime::createFromFormat("d/m/Y", $stagefin);

            if (!empty($stagefin)) {
                $eleves->setStageFin($stagefin);
            }

            // la date du CNED
            $dateCNED = $form->get('date_cned')->getData();

            $dateCNED = DateTime::createFromFormat("d/m/Y", $dateCNED);

            if (!empty($dateCNED)) {
                $eleves->setDateCned($dateCNED);
            }

            // la date d'incription au CNED
            $inscriptionCNED = $form->get('date_inscription_cned')->getData();

            $inscriptionCNED = DateTime::createFromFormat("d/m/Y", $inscriptionCNED);

            if (!empty($inscriptionCNED)) {
                $eleves->setDateInscriptionCned($inscriptionCNED);
            }

            // le dipositif d'aide
            $dispositif = $form->get('dispositif_aide')->getData();
            $valeurdispositif = $form->get('valeur_dispositif')->getData();

            if ($dispositif == 'Autre' && !empty($valeurdispositif)) {
                $eleves->setDispositifAide($chiffrementService->encode($valeurdispositif));
            }

            // on converti les nombre en int pour enfants, montant et annee_formation
            $enfants = $form->get('enfants')->getData();
            if (!empty($enfants)) {
                $eleves->setEnfants(intval($enfants));
            }
            $montant = $form->get('montant')->getData();
            if (!empty($montant)) {
                $eleves->setMontant(intval($montant));
            }
            $anneeFormation = $form->get('annee_formation')->getData();
            if (!empty($anneeFormation)) {
                $eleves->setAnneeFormation(intval($anneeFormation));
            }

            $entityManager->persist($eleves);
            $entityManager->flush();
        }



        $entityClassName = 'App\Entity\Eleves';
        $metadata = $entityManager->getClassMetadata($entityClassName);
        $fieldNames = $metadata->getFieldNames();
        $infoEleves = [];

        foreach ($fieldNames as $fieldName) {
            if ($fieldName != 'photo' && $fieldName != 'transport' && $fieldName != 'date_naissance' && $fieldName != 'date_inscription' && $fieldName != 'date_fin_suivi' && $fieldName != 'cotisations_date' && $fieldName != 'stage_debut' && $fieldName != 'stage_fin' && $fieldName != 'dispositif_aide' && $fieldName != 'enfants' && $fieldName != 'annee_formation' && $fieldName != 'educateurs_id' && $fieldName != 'date_cned' && $fieldName != 'date_inscription_cned' && $fieldName != 'montant' && $fieldName != 'civilite') {
                // on récupère le nom du champ et on le transforme pour pouvoir faire un setNomDuChamp
                $test = strtolower($fieldName);
                $test = explode('_', $test);
                $maj = [];
                foreach ($test as $tes) {
                    $tes = ucfirst($tes);
                    $maj[] = $tes;
                }
                if ($fieldName == 'validation_inscription' || $fieldName == 'ordinateur' || $fieldName == 'droit_image' || $fieldName == 'suivi' || $fieldName == 'cotisations' || $fieldName == 'complet') {
                    $test = 'is' . join($maj);
                } else {
                    $test = 'get' . join($maj);
                }
                // on déchiffre l'information
                if (!empty($eleves->$test())) {
                    $info = $chiffrementService->decode($eleves->$test());
                }
                $infoEleves[strtolower($fieldName)] = $info;
            }
        }

        //dn = date de naissance
        $dn = $eleves->getDateNaissance();
        if (!empty($dn)) {
            $dn = $dn->format('d/m/Y');
        }

        //di = date d'inscription
        $inscri = $eleves->isValidationInscription();
        $di = $eleves->getDateInscription();
        if (!empty($di) && $inscri == true) {
            $di = $di->format('d/m/Y');
        } else {
            $di = '';
        }

        //dfs = date de fin de suivi
        $dfs = $eleves->getDateFinSuivi();
        if (!empty($dfs)) {
            $dfs = $dfs->format('d/m/Y');
        }

        //dc = date de cotisations
        $dc = $eleves->getCotisationsDate();
        if (!empty($dc)) {
            $dc = $dc->format('d/m/Y');
        }

        //sd = debut stage
        $sd = $eleves->getStageDebut();
        if (!empty($sd)) {
            $sd = $sd->format('d/m/Y');
        }

        //sf = fin stage
        $sf = $eleves->getStageFin();
        if (!empty($sf)) {
            $sf = $sf->format('d/m/Y');
        }

        //dcned = date cned
        $dcned = $eleves->getStageFin();
        if (!empty($dcned)) {
            $dcned = $dcned->format('d/m/Y');
        }

        //dicned = date inscription cned
        $dicned = $eleves->getStageFin();
        if (!empty($dicned)) {
            $dicned = $dicned->format('d/m/Y');
        }

        //da = dispositif d'aide
        $da = $eleves->getDispositifAide();
        if (!empty($da && $da != 'Mission Locale' && $da != 'Bourse')) {
            $da = [
                'choix' => 'Autre',
                'valeur' => $da
            ];
        } else {
            $da = [
                'choix' => $da,
                'valeur' => ''
            ];
        }

        $transports = $transportsRepository->findBy(['eleves' => $eleves]);

        foreach ($transports as $transport) {
            $tableau[] = [
                'id' => $transport->getId(),
                'transport' => $transport->getTransport(),
            ];
        }

        if (empty($tableau)) {
            $tableau = 'vide';
        }

        return $this->render('main/eleve/infos.html.twig', [
            'elevesRepository' => $elevesRepository->findBy([], ['nom' => 'ASC']),
            'eleves' => $eleves,
            'infoEleves' => $infoEleves,
            'dn' => $dn,
            'dcned' => $dcned,
            'dicned' => $dicned,
            'di' => $di,
            'dfs' => $dfs,
            'dc' => $dc,
            'sd' => $sd,
            'sf' => $sf,
            'da' => $da,
            'tableau' => $tableau,
            'elevesForm' => $form->createView(),
        ]);
    }
}
