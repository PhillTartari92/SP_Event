<?php

namespace App\Controller;



use App\Repository\AjoutEvenementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FiltreController extends AbstractController
{
    #[Route('/filtre/{id}', name: 'app_filtre')]
    public function index(AjoutEvenementRepository $ajoutEvenementRepository): Response
    {
        $events = $ajoutEvenementRepository->findAll();

        return $this->render('filtre/index.html.twig', [
            'events' => $events,
        ]);
    }
}
