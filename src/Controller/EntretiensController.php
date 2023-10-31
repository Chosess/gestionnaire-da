<?php

namespace App\Controller;

use App\Entity\Eleves;
use App\Entity\Entretiens;
use App\Form\EntretiensFormType;
use App\Repository\ElevesRepository;
use App\Repository\EntretiensRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class EntretiensController extends AbstractController
{
    #[Route('/{id}/suivi', name: '_suivi')]
    public function suivi(Eleves $eleves, ElevesRepository $elevesRepository, Request $request, EntityManagerInterface $entityManager, EntretiensRepository $entretiensRepository, Session $session, Security $security): Response
    {
        // on redirige l'utilisateur si il n'est pas connecté
        $user = $security->getUser();

        if(empty($user)){
            return $this->redirectToRoute('app_login');
        }

        // on met l'id de l'élève dans la session
        $session->set('eleve', $eleves->getId());

        $entretiens = new Entretiens;

        $entretiensForm = $this->createForm(EntretiensFormType::class);
        $entretiensForm->handleRequest($request);

        if ($entretiensForm->isSubmitted() && $entretiensForm->isValid()) {

            $date = $entretiensForm->get('date')->getData();

            $date = DateTime::createFromFormat("d/m/Y", $date);
            $entretiens->setDate($date);

            $commentaire = $entretiensForm->get('commentaire')->getData();

            $entretiens->setCommentaire($commentaire);

            $entretiens->setEleves($eleves);
            $eleves->addEntretien($entretiens);

            $entityManager->persist($entretiens);
            $entityManager->persist($eleves);
            $entityManager->flush();
        }

        $er = $entretiensRepository->findBy(['eleves' => $eleves->getId()]);

        foreach ($er as $entretien) {
            $commentaire = $entretien->getCommentaire();
            // si le commentaire fait plus de 50 caractères, on le coupe
            if (strlen($commentaire) > 50) {
                $commentaire = substr($commentaire, 0, 50) . ' ...';
            }
            $infosEntretiens[] = [
                'commentaire' => $commentaire,
                'date' => $entretien->getDate()->format('d/m/Y'),
                'id' => $entretien->getId(),
            ];
        }

        if (empty($infosEntretiens)) {
            $infosEntretiens = 'vide';
        }

        return $this->render('main/entretien/entretiens.html.twig', [
            'elevesRepository' => $elevesRepository->findBy([], ['nom' => 'ASC']),
            'eleves' => $eleves,
            'infosEntretiens' => $infosEntretiens,
            'entretiensForm' => $entretiensForm->createView(),
        ]);
    }

    #[Route('/suivi/{id}', name: '_suivimodif')]
    public function modifsuivi(Entretiens $entretiens, ElevesRepository $elevesRepository, Request $request, EntityManagerInterface $entityManager, EntretiensRepository $entretiensRepository, Session $session, Security $security): Response
    {
        // on redirige l'utilisateur si il n'est pas connecté
        $user = $security->getUser();

        if(empty($user)){
            return $this->redirectToRoute('app_login');
        }

        $eleves = $elevesRepository->findOneBy(['id' => $session->get('eleve')]);

        $entretiensForm = $this->createForm(EntretiensFormType::class);
        $entretiensForm->handleRequest($request);

        if ($entretiensForm->isSubmitted() && $entretiensForm->isValid()) {

            $date = $entretiensForm->get('date')->getData();

            $date = DateTime::createFromFormat("d/m/Y", $date);
            $entretiens->setDate($date);

            $commentaire = $entretiensForm->get('commentaire')->getData();

            $entretiens->setCommentaire($commentaire);

            $entretiens->setEleves($eleves);
            $eleves->addEntretien($entretiens);

            $entityManager->persist($entretiens);
            $entityManager->persist($eleves);
            $entityManager->flush();
        }

        $er = $entretiensRepository->findBy(['eleves' => $eleves->getId()]);

        foreach ($er as $entretien) {
            $commentaire = $entretien->getCommentaire();
            // si le commentaire fait plus de 50 caractères, on le coupe
            if (strlen($commentaire) > 50) {
                $commentaire = substr($commentaire, 0, 50) . ' ...';
            }
            $infosEntretiens[] = [
                'commentaire' => $commentaire,
                'date' => $entretien->getDate()->format('d/m/Y'),
                'id' => $entretien->getId(),
            ];
        }

        if (empty($infosEntretiens)) {
            $infosEntretiens = 'vide';
        }

        $valeurs = [
            'commentaire' => $entretiens->getCommentaire(),
            'date' => $entretiens->getDate()->format('d/m/Y'),
        ];

        return $this->render('main/entretien/entretiensmodif.html.twig', [
            'elevesRepository' => $elevesRepository->findBy([], ['nom' => 'ASC']),
            'eleves' => $eleves,
            'id' => $entretiens->getId(),
            'valeurs' => $valeurs,
            'infosEntretiens' => $infosEntretiens,
            'entretiensForm' => $entretiensForm->createView(),
        ]);
    }
}
