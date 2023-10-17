<?php

namespace App\Controller;

use App\Entity\Documents;
use App\Entity\Eleves;
use App\Form\DocumentsFormType;
use App\Repository\DocumentsRepository;
use App\Repository\ElevesRepository;
use App\Service\FileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocumentsController extends AbstractController
{
    #[Route('/{id}/documents', name: '_documents')]
    public function documents(Eleves $eleves, ElevesRepository $elevesRepository, Request $request, EntityManagerInterface $entityManager, DocumentsRepository $documentsRepository, FileService $fileService): Response
    {
        foreach ($documentsRepository->findBy(['eleves' => $eleves->getId()]) as $doc) {
            $titre = explode('---', $doc->getDocument())[1];
            if(strlen($titre) > 15){
                $titre = substr($titre, 0, 15) . '...';
            }
            $docs[] = [
                'id' => $doc->getId(),
                'titre' => $titre,
                'name' => $doc->getDocument()
            ];
        }

        $documentsForm = $this->createForm(DocumentsFormType::class);
        $documentsForm->handleRequest($request);

        if ($documentsForm->isSubmitted() && $documentsForm->isValid()) {

            // l'ajout de document
            $addDocument = $documentsForm->get('add')->getData();

            // on vérifie qu'il y ait un fichier envoyé
            if (!empty($addDocument)) {

                // on ajoute le document
                foreach ($addDocument as $add) {
                    $documents = new Documents;

                    $fichier = $fileService->add($add, 'file');
                    $documents->setDocument($fichier);
                    $eleves->addDocument($documents);

                    $entityManager->persist($eleves);
                    $entityManager->persist($documents);
                    $entityManager->flush();
                }
            }

            // la suppression de document
            $removeDocuments = $documentsForm->get('remove')->getData();

            if (!empty($removeDocuments)) {
                foreach (explode(',', $removeDocuments) as $removedocument) {
                    $remdoc = $documentsRepository->findOneBy(['id' => $removedocument]);
                    $fileService->delete($remdoc->getDocument(), 'file');
                    $remdoc->setEleves(null);
                    $eleves->removeDocument($remdoc);
                    $entityManager->remove($remdoc);
                    $entityManager->persist($eleves);
                    $entityManager->flush();
                }
            }

        }

        if (empty($docs)) {
            $docs = '';
        }

        return $this->render('main/documents.html.twig', [
            'elevesRepository' => $elevesRepository->findBy([], ['nom' => 'ASC']),
            'eleves' => $eleves,
            'docs' => $docs,
            'documentsForm' => $documentsForm->createView(),
        ]);
    }
}
