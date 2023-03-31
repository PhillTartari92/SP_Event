<?php

namespace App\Controller;

use App\Entity\AjoutEvenement;
use App\Form\AjoutEvenementType;
use App\Repository\AjoutEvenementRepository;
use App\Services\UploadFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/evenement')]
class AjoutEvenementController extends AbstractController
{
    #[Route('/ajout', name: 'app_ajout_evenement_index', methods: ['GET'])]
    public function index(AjoutEvenementRepository $ajoutEvenementRepository): Response
    {

        $userId = $this->getUser()->getId();
// dd($userId);
        // $ajout_evenemets = $ajoutEvenementRepository->findBy(['user_id' => $userId]);

        $userEvent = $ajoutEvenementRepository->findByUserId($userId);

        return $this->render('ajout_evenement/index.html.twig', [
            'ajout_evenements' => $userEvent,
           
        ]);
    }

    #[Route('/new', name: 'app_ajout_evenement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AjoutEvenementRepository $ajoutEvenementRepository, UploadFile $uploadFile): Response
    {
        $ajoutEvenement = new AjoutEvenement();
        $form = $this->createForm(AjoutEvenementType::class, $ajoutEvenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ajoutEvenement->setUserId($this->getUser());
            $ajoutEvenement->setCreatedAT(new \DateTime());
          
            $image = $form->get('image')->getData();
            $ajoutEvenement->setImage($uploadFile->moveFile($image));      
          
            $ajoutEvenementRepository->save($ajoutEvenement, true);

            return $this->redirectToRoute('app_ajout_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ajout_evenement/new.html.twig', [
            'ajout_evenement' => $ajoutEvenement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ajout_evenement_show', methods: ['GET'])]
    public function show(AjoutEvenement $ajoutEvenement): Response
    {
        return $this->render('ajout_evenement/show.html.twig', [
            'ajout_evenement' => $ajoutEvenement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ajout_evenement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AjoutEvenement $ajoutEvenement, AjoutEvenementRepository $ajoutEvenementRepository, UploadFile $uploadFile): Response
    {
        $form = $this->createForm(AjoutEvenementType::class, $ajoutEvenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $image = $form->get('image')->getData();
            $ajoutEvenement->setImage($uploadFile->moveFile($image));   

            $ajoutEvenementRepository->save($ajoutEvenement, true);

            return $this->redirectToRoute('app_ajout_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ajout_evenement/edit.html.twig', [
            'ajout_evenement' => $ajoutEvenement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ajout_evenement_delete', methods: ['POST'])]
    public function delete(Request $request, AjoutEvenement $ajoutEvenement, AjoutEvenementRepository $ajoutEvenementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ajoutEvenement->getId(), $request->request->get('_token'))) {
            $ajoutEvenementRepository->remove($ajoutEvenement, true);
        }

        return $this->redirectToRoute('app_ajout_evenement_index', [], Response::HTTP_SEE_OTHER);
    }
}
