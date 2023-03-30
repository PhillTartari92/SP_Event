<?php

namespace App\Controller;

use App\Entity\AjoutEvenement;
use App\Form\AjoutEvenementType;
use App\Repository\AjoutEvenementRepository;
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

        $ajout_evenemets = $ajoutEvenementRepository->findBy(['id' => $userId]);

        $userEvent = $ajoutEvenementRepository->findByUserId($userId);

        
        return $this->render('ajout_evenement/index.html.twig', [
            'ajout_evenements' => $ajout_evenemets,
        ]);
    }

    #[Route('/new', name: 'app_ajout_evenement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AjoutEvenementRepository $ajoutEvenementRepository): Response
    {
        $ajoutEvenement = new AjoutEvenement();
        $form = $this->createForm(AjoutEvenementType::class, $ajoutEvenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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

    #[Route('/admin/{id}/edit', name: 'app_ajout_evenement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AjoutEvenement $ajoutEvenement, AjoutEvenementRepository $ajoutEvenementRepository): Response
    {
        $form = $this->createForm(AjoutEvenementType::class, $ajoutEvenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
