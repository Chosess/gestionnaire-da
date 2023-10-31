<?php

namespace App\Controller;

use App\Entity\Absences;
use App\Entity\Documents;
use App\Entity\Eleves;
use App\Form\AbsencesFormType;
use App\Repository\AbsencesRepository;
use App\Repository\ElevesRepository;
use App\Service\FileService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class AbsencesController extends AbstractController
{
    #[Route('/{id}/absences', name: '_absences')]
    public function absences(Eleves $eleves, ElevesRepository $elevesRepository, Request $request, AbsencesFormType $absencesForm, EntityManagerInterface $entityManager, AbsencesRepository $absencesRepository, Session $session, FileService $fileService, Security $security): Response
    {
        // on redirige l'utilisateur si il n'est pas connecté
        $user = $security->getUser();

        if(empty($user)){
            return $this->redirectToRoute('app_login');
        }

        // on met l'id de l'élève dans la session
        $session->set('eleve', $eleves->getId());

        $mois = date("n");
        $annee = date('Y');

        // Déterminez le premier jour du mois
        $premierJour = mktime(0, 0, 0, $mois, 1, $annee);

        // Déterminez le dernier jour du mois
        $dernierJour = mktime(0, 0, 0, $mois + 1, 0, $annee);

        // Utilisez une boucle pour itérer à travers les jours du mois
        for ($jour = $premierJour; $jour <= $dernierJour; $jour = strtotime('+1 day', $jour)) {
            $jours[] = [
                'annee' => date('Y', $jour),
                'mois' => date('m', $jour),
                'jour' => date('d', $jour)
            ];
        }

        for ($j = 0; $j < (date('N', $premierJour) - 1); $j++) {
            $infosUtiles['jourUn'][] = $j;
        }

        $calculJourDernier = 7 - (((date('N', $premierJour) - 1) + date('d', $dernierJour)) % 7);
        for ($jd = 0; $jd < $calculJourDernier; $jd++) {
            $infosUtiles['jourDernier'][] = $j;
        }

        $infosUtiles['jourActuel'] = [
            'annee' => date('Y', time()),
            'mois' => date('m', time()),
            'jour' => date('d', time())
        ];

        $absences = new Absences;

        $absencesForm = $this->createForm(AbsencesFormType::class, $absences);
        $absencesForm->handleRequest($request);


        if ($absencesForm->isSubmitted() && $absencesForm->isValid()) {

            // la date de début
            $debut = $absencesForm->get('debut')->getData();

            // la date de fin
            $fin = $absencesForm->get('fin')->getData();

            if (DateTime::createFromFormat("d/m/Y", $debut) <= DateTime::createFromFormat("d/m/Y", $fin)) :
                // traitement de la date de début
                $debut = DateTime::createFromFormat("d/m/Y", $debut);

                if (!empty($debut)) {
                    $absences->setDebut($debut);
                }

                // traitement de la date de fin
                $fin = DateTime::createFromFormat("d/m/Y", $fin);

                $absences->setFin($fin);

                // le fichier 
                $files = $absencesForm->get('document')->getData();

                if(!empty($files)){
                    foreach($files as $file){
                        $file = $fileService->add($file, 'file');
                        $absences->setDocument($file);
                        $document = new Documents;
                        $document->setDocument($file);
                        $eleves->addDocument($document);
                        $entityManager->persist($document);
                    }
                }

                
                $eleves->addAbsence($absences);
                $entityManager->persist($eleves);

                $entityManager->persist($absences);
                $entityManager->flush();

            endif;
        }

        $abs = $absencesRepository->findBy(['eleves' => $eleves->getId()], ['debut' => 'DESC']);
        foreach ($abs as $ab) {
            //on vérifie si le motif dépasse 50 caractères
            $motif = $ab->getMotif();
            // si il l'est on le coupe à 50 caractères
            if (strlen($motif) > 50) {
                $motif = substr($motif, 0, 50) . ' ...';
            }
            $infosAbsences[] = [
                'id' => $ab->getId(),
                'debut' => $ab->getDebut()->format('d/m/Y'),
                'fin' => $ab->getFin()->format('d/m/Y'),
                'motif' => $motif,
                'justif' => $ab->isJustif()
            ];
        }

        if (empty($infosAbsences)) {
            $infosAbsences = 'vide';
        }

        return $this->render('main/absence/absences.html.twig', [
            'elevesRepository' => $elevesRepository->findBy([], ['nom' => 'ASC']),
            'eleves' => $eleves,
            'infosAbsences' => $infosAbsences,
            'jours' => $jours,
            'infosUtiles' => $infosUtiles,
            'absencesForm' => $absencesForm->createView()
        ]);
    }

    #[Route('/absences/{id}', name: '_modif')]
    public function absence(Absences $absences, ElevesRepository $elevesRepository, Request $request, AbsencesFormType $absencesForm, EntityManagerInterface $entityManager, Session $session, AbsencesRepository $absencesRepository, FileService $fileService, Security $security): Response
    {
        // on redirige l'utilisateur si il n'est pas connecté
        $user = $security->getUser();

        if(empty($user)){
            return $this->redirectToRoute('app_login');
        }

        $mois = date("n");
        $annee = date('Y');

        // Déterminez le premier jour du mois
        $premierJour = mktime(0, 0, 0, $mois, 1, $annee);

        // Déterminez le dernier jour du mois
        $dernierJour = mktime(0, 0, 0, $mois + 1, 0, $annee);

        // Utilisez une boucle pour itérer à travers les jours du mois
        for ($jour = $premierJour; $jour <= $dernierJour; $jour = strtotime('+1 day', $jour)) {
            $jours[] = [
                'annee' => date('Y', $jour),
                'mois' => date('m', $jour),
                'jour' => date('d', $jour)
            ];
        }

        for ($j = 0; $j < (date('N', $premierJour) - 1); $j++) {
            $infosUtiles['jourUn'][] = $j;
        }

        $calculJourDernier = 7 - (((date('N', $premierJour) - 1) + date('d', $dernierJour)) % 7);
        for ($jd = 0; $jd < $calculJourDernier; $jd++) {
            $infosUtiles['jourDernier'][] = $j;
        }

        $infosUtiles['jourActuel'] = [
            'annee' => date('Y', time()),
            'mois' => date('m', time()),
            'jour' => date('d', time())
        ];

        $absencesForm = $this->createForm(AbsencesFormType::class, $absences);
        $absencesForm->handleRequest($request);

        $session->get('eleve');
        $criteria = ['id' => $session->get('eleve')];

        $eleves = $elevesRepository->findOneBy($criteria);


        if ($absencesForm->isSubmitted() && $absencesForm->isValid()) {

            // la date de début
            $debut = $absencesForm->get('debut')->getData();

            // la date de fin
            $fin = $absencesForm->get('fin')->getData();

            if (DateTime::createFromFormat("d/m/Y", $debut) <= DateTime::createFromFormat("d/m/Y", $fin)) :
                // traitement de la date de début
                $debut = DateTime::createFromFormat("d/m/Y", $debut);

                if (!empty($debut)) {
                    $absences->setDebut($debut);
                }

                // traitement de la date de fin
                $fin = DateTime::createFromFormat("d/m/Y", $fin);

                $absences->setFin($fin);

                // le fichier 
                $files = $absencesForm->get('document')->getData();

                if(!empty($files)){
                    foreach($files as $file){
                        $file = $fileService->add($file, 'file');
                        $absences->setDocument($file);
                        $document = new Documents;
                        $document->setDocument($file);
                        $eleves->addDocument($document);
                        $entityManager->persist($document);
                    }
                }


                $eleves->addAbsence($absences);
                $entityManager->persist($eleves);

                $entityManager->persist($absences);
                $entityManager->flush();

            endif;
        }

        $abs = $absencesRepository->findBy(['eleves' => $eleves->getId()], ['debut' => 'DESC']);
        foreach ($abs as $ab) {
            //on récupère le motif
            $motif = $ab->getMotif();
            // on vérifie si le motif dépasse 50 caractères si il l'est on le coupe à 50 caractères
            if (strlen($motif) > 50) {
                $motif = substr($motif, 0, 50) . ' ...';
            }
            $infosAbsences[] = [
                'id' => $ab->getId(),
                'debut' => $ab->getDebut()->format('d/m/Y'),
                'fin' => $ab->getFin()->format('d/m/Y'),
                'motif' => $motif,
                'justif' => $ab->isJustif()
            ];
        }

        $absences = [
            'debut' => $absences->getDebut()->format('d/m/Y'),
            'fin' => $absences->getFin()->format('d/m/Y'),
            'motif' => $absences->getMotif(),
            'justif' => $absences->isJustif(),
            'document' => $absences->getDocument(),
            'id' => $absences->getId(),
        ];

        if(empty($infosAbsences)){
            $infosAbsences = 'vide';
        }


// dd(openssl_get_cipher_methods());


        // $data = 'un truc bidon';
        // $cipher_algo = 'aes-256-cbc';
        // $passphrase =
        // $test = openssl_encrypt(
        //     $data,
        //     $cipher_algo,
        //     $passphrase,
        //     $options = 0,
        //     $iv = "",
        //     $tag = null,
        //     $aad = "",
        //     $tag_length = 16
        // );


        return $this->render('main/absence/absencemodif.html.twig', [
            'elevesRepository' => $elevesRepository->findBy([], ['nom' => 'ASC']),
            'eleves' => $eleves,
            'absences' => $absences,
            'infosAbsences' => $infosAbsences,
            'jours' => $jours,
            'infosUtiles' => $infosUtiles,
            'absencesForm' => $absencesForm->createView()
        ]);
    }
}
