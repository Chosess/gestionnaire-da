<?php

namespace App\Controller;

use App\Entity\Eleves;
use App\Repository\ElevesRepository;
use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use IntlDateFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AbsencesController extends AbstractController
{
    #[Route('/{id}/absences', name: '_absences')]
    public function absences(Eleves $eleves, ElevesRepository $elevesRepository): Response
    {
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



        return $this->render('main/absences.html.twig', [
            'elevesRepository' => $elevesRepository->findBy([], ['nom' => 'ASC']),
            'eleves' => $eleves,
            'jours' => $jours,
            'infosUtiles' => $infosUtiles,
        ]);
    }
}
