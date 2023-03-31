<?php

namespace App\Controller;

use App\Repository\AjoutEvenementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(AjoutEvenementRepository $ajoutEvenementRepository): Response
    {
        $events = $ajoutEvenementRepository->findAll();
        // dd($events);
        return $this->render('home/index.html.twig', [
            'events'=> $events
        ]);
    }
}
